<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InvoiceDetailCreateRequest;
use App\Http\Requests\InvoiceDetailUpdateRequest;
use App\Repositories\IncentiveRepository;
use App\Repositories\InvoiceDetailRepository;
use App\Repositories\InvoiceRepository;
use App\Validators\InvoiceDetailValidator;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * Class InvoiceDetailsController.
 *
 * @package namespace App\Http\Controllers;
 */
class InvoiceDetailsController extends Controller
{
    protected $modul;
    /**
     * @var InvoiceDetailRepository
     */
    protected $repository;
    protected $invoiceRepository;
    protected $incentiveRepository;
    /**
     * @var InvoiceDetailValidator
     */
    protected $validator;

    /**
     * InvoiceDetailsController constructor.
     *
     * @param InvoiceDetailRepository $repository
     * @param InvoiceDetailValidator $validator
     */
    public function __construct(
        InvoiceDetailRepository $repository,
        InvoiceDetailValidator $validator,
        InvoiceRepository $invoiceRepository,
        IncentiveRepository $incentiveRepository
    ) {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->modul = 'pembayaran';
        $this->invoiceRepository = $invoiceRepository;
        $this->incentiveRepository = $incentiveRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $invoiceDetails = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $invoiceDetails,
            ]);
        }

        return view('invoiceDetails.index', compact('invoiceDetails'));
    }

    public function create($id)
    {
        $invoice = $this->invoiceRepository->find($id);
        $modul = $this->modul;
        return view('invoiceDetails.create', compact('modul', 'invoice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InvoiceDetailCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(InvoiceDetailCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $input = $request->all();
            $invoiceDetail = $this->repository->create($input);
            if ($request->has('volume')) {
                for ($i = 0; $i < count($request->volume); $i++) {
                    $data_incentive = [
                        'volume' => $request->volume[$i],
                        'kinerja' => $request->kinerja[$i],
                        'invoice_detail_id' => $invoiceDetail->id
                    ];
                    $this->incentiveRepository->create($data_incentive);
                }
            }
            $response = [
                'message' => 'InvoiceDetail created.',
                'data'    => $invoiceDetail->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }
            Alert::success('Berhasil', 'Berhasil menambahkan peserta tagihan');
            return back();
            // return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            Alert::error('Gagal', 'Terjadi Kesalahan' . $e->getMessage());
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
        $invoiceDetail = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $invoiceDetail,
            ]);
        }

        return view('invoiceDetails.show', compact('invoiceDetail'));
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
        $invoiceDetail = $this->repository->find($id);

        return view('invoiceDetails.edit', compact('invoiceDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InvoiceDetailUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(InvoiceDetailUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $invoiceDetail = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'InvoiceDetail updated.',
                'data'    => $invoiceDetail->toArray(),
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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'InvoiceDetail deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'InvoiceDetail deleted.');
    }
}
