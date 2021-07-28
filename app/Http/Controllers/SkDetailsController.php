<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SkDetailCreateRequest;
use App\Http\Requests\SkDetailUpdateRequest;
use App\Repositories\CandidateProfileRepository;
use App\Repositories\FormationRepository;
use App\Repositories\GttRepository;
use App\Repositories\InvoiceDetailRepository;
use App\Repositories\SkDetailRepository;
use App\Repositories\SkRepository;
use App\User;
use App\Validators\SkDetailValidator;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * Class SkDetailsController.
 *
 * @package namespace App\Http\Controllers;
 */
class SkDetailsController extends Controller
{
    /**
     * @var SkDetailRepository
     */
    protected $repository;
    protected $gttRepository;
    protected $candidateRepository;
    protected $formationRepository;
    protected $skRepository;
    protected $invoiceDetailRepostory;

    /**
     * @var SkDetailValidator
     */
    protected $validator;

    /**
     * SkDetailsController constructor.
     *
     * @param SkDetailRepository $repository
     * @param SkDetailValidator $validator
     */
    public function __construct(
        SkDetailRepository $repository,
        SkDetailValidator $validator,
        GttRepository $gttRepository,
        CandidateProfileRepository $candidateProfileRepository,
        FormationRepository $formationRepository,
        SkRepository $skRepository,
        InvoiceDetailRepository $invoiceDetailRepository
    ) {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->gttRepository = $gttRepository;
        $this->candidateRepository = $candidateProfileRepository;
        $this->formationRepository = $formationRepository;
        $this->skRepository = $skRepository;
        $this->invoiceDetailRepostory = $invoiceDetailRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $skDetails = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $skDetails,
            ]);
        }

        return view('skDetails.index', compact('skDetails'));
    }

    public function create($sk_id)
    {
        $modul = 'Peserta';
        $sk = $this->skRepository->find($sk_id);
        return view('skDetails.create', compact('modul', 'sk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SkDetailCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SkDetailCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            if($request->has('peserta')){
                foreach ($request->peserta as $val) {
                    $this->repository->create([
                        'sk_id' => $request->sk,
                        'gtt_id' => $val
                    ]);
                }
            }
            $response = [
                'message' => 'SkDetail created.',
                'data'    => '',
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            Alert::success('Berhasil', 'Berhasil tambahkan peserta sk');
            return back();
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            Alert::error('Gagal', $e->getMessageBag());
            return back();
            // return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $skDetail = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $skDetail,
            ]);
        }

        return view('skDetails.show', compact('skDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $skDetail = $this->repository->find($id);

        return view('skDetails.edit', compact('skDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SkDetailUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SkDetailUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $skDetail = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'SkDetail updated.',
                'data'    => $skDetail->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cek = $this->repository->find($id);
        if (!empty($cek)){
            $cek_invoice = $this->invoiceDetailRepostory->whereGttId($cek->gtt_id)->first();
            // dd($cek_invoice);
            if (!empty($cek_invoice)){
                Alert::error('Gagal','Data tidak bisa dihapus karena sudah ada pembayaran');
                return back();
            }
            $deleted = $this->repository->delete($id);

            if (request()->wantsJson()) {

                return response()->json([
                    'message' => 'SkDetail deleted.',
                    'deleted' => $deleted,
                ]);
            }
            Alert::success('Berhasil', 'Berhasil hapus data peserta');
            return back();
            return redirect()->back()->with('message', 'SkDetail deleted.');
        }
    }

}
