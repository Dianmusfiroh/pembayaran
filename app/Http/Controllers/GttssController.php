<?php

namespace App\Http\Controllers;

use App\Entities\Sk;
use App\Entities\Institute;
use App\Entities\Qualification;
use App\Entities\SkDetail;
use App\Entities\Jabatan;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\GttCreateRequest;
use App\Http\Requests\GttUpdateRequest;
use App\Repositories\GttRepository;

use App\Repositories\SkRepository;
use App\Repositories\SkDetailRepository;
use App\Repositories\InstituteRepository;
use App\Repositories\QualificationRepository;
use App\Repositories\JabatanRepository;

use App\Validators\GttValidator;
use phpDocumentor\Reflection\Types\This;

/**
 * Class GttsController.
 *
 * @package namespace App\Http\Controllers;
 */
class GttssController extends Controller
{
    /**
     * @var GttRepository
     */
    protected $skRepo;
    protected $sk_detailRepo;
    protected $instituteRepo;
    protected $qulificationRepo;
    protected $jabatanRepo;
    protected $repository;

    /**
     * @var GttValidator
     */
    protected $validator;

    /**
     * GttsController constructor.
     *
     * @param GttRepository $repository
     * @param GttValidator $validator
     */
    public function __construct(GttRepository $repository, GttValidator $validator, InstituteRepository $instituteRepo, QualificationRepository $qualificationRepo, SkRepository $skRepo, SkDetail $sk_detailRepo, JabatanRepository $jabatanRepo)
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->validator  = $validator;

        $this->skRepo = $skRepo;
        $this->sk_detailRepo = $sk_detailRepo;
        $this->instituteRepo = $instituteRepo;
        $this->qualificationRepo = $qualificationRepo;
        $this->jabatanRepo = $jabatanRepo;

        $this->modul = 'gtt';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modul = $this->modul;

        // $sk_id = $id;

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $gtts = $this->repository->all();
        if (request()->wantsJson()) {

            return response()->json([
                'data' => $gtts,
            ]);
        }

        return view('gtt.index', compact('gtts', 'modul'));
    }

    // public function create($id)
    // {
    //     $modul = $this->modul;
    //     $institutes = Institute::all();
    //     $qualifications = Qualification::all();
    //     $jabatans = Jabatan::all();
    //     $sk_id = $id;

    //     // return redirect('apps/gtt/'.$sk->id.'/create');
    //     return view('gtt.create', compact('modul', 'institutes', 'qualifications', 'jabatans', 'sk_id'));
    // }
    public function create()
    {
        $modul = $this->modul;
        $institutes = $this->instituteRepo->all();
        $qualifications = Qualification::all();
        $jabatans = $this->jabatanRepo->all();
        // $sk_id = $id;

        // return redirect('apps/gtt/'.$sk->id.'/create');
        // return view('gtt.create', compact('modul', 'institutes', 'qualifications', 'jabatans', 'sk_id'));
        return view('gtt.create', compact('modul', 'institutes', 'qualifications', 'jabatans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GttCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(GttCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $input = $request->all();
            // $sk = $this->skRepo->find($request->sk_id);
            // $input['tmt_start'] = $sk->start_date;
            // $input['tmt_end'] = $sk->end_date;
            $gtt = $this->repository->create($input);
            SkDetail::updateOrCreate([
                // 'sk_id' => $sk->id,
                'gtt_id' => $gtt->id
            ]);
            $response = [
                'message' => 'Gtt created.',
                'data'    => $gtt->toArray(),
            ];

            if ($request->is('api*')) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
            // return redirect('master/gtt');

        } catch (ValidatorException $e) {
            if ($request->is('api*')) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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

        $gtts = $this->repository->find($id);
        $modul = $this->modul;

        return view('sk.edit', compact('sk', 'modul'));


        if (request()->is('api*')) {

            return response()->json([
                'data' => $gtts,
            ]);
        }

        return view('gtt.show', compact('gtts','modul'));
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
        $gtt = $this->repository->find($id);

        $modul = $this->modul;

        // $sks = Sk::all();
        $sks = $this->skRepo->all();
        // $skdetails = $this->sk_detailRepo->all();
        $skdetails = SkDetail::all();
        $institutes = $this->instituteRepo->all();
        $qualifications = $this->qualificationRepo->all();
        $jabatans = $this->jabatanRepo->all();
        // $institutes = Institute::all();
        // $qualifications = Qualification::all();

        // $sk_id = SkDetail::whereGttId($id)->get();
        $sk_id = SkDetail::whereGttId($id)->where('sk_id', '<>', null)->first('sk_id');
        $sk_id = $sk_id->sk_id;

        return view('gtt.edit', compact('gtt', 'modul', 'institutes', 'qualifications', 'sks', 'jabatans', 'skdetails', 'sk_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GttUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(GttUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $gtt = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Gtt updated.',
                'data'    => $gtt->toArray(),
            ];

            if ($request->is('api*')) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
            // return redirect()->url()->previous();
            // return redirect('apps/gtt', $sk_id);

        } catch (ValidatorException $e) {

            if ($request->is('api*')) {

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
                'message' => 'gtt deleted.',
                'deleted' => $deleted,
            ]);
        }
        return redirect()->back()->with('message', 'Gtt deleted.');
        // return redirect('master/skdetail/destroy', compact('id'));
    }

    // public function search()
    // {
    //     $search = request()->search;
    //     $invoice_id = request()->invoice_id;
    //     $response = array();
    //     if (request()->searchFields != 'id:='){
    //         // if ($search == '') {
    //         //     $gtts = $this->repository->scopeQuery(function ($query) {
    //         //         return $query->limit(10);
    //         //     })->all(['id', 'full_name']);
    //         // } else {
    //         //     $gtts = $this->repository->all(['id', 'full_name']);
    //         // }
    //         $gtts = $this->repository->scopeQuery(function ($query) use($invoice_id) {
    //             return $query->whereNotIn('id',function($q) use($invoice_id){
    //                 return $q->select('gtt_id')->from('invoice_details')->whereInvoiceId($invoice_id)->get();
    //             })->limit(10);
    //         })->all(['id', 'full_name']);
    //         foreach ($gtts as $gtt) {
    //             $response[] = array(
    //                 "id" => $gtt->id,
    //                 "text" => $gtt->full_name,
    //             );
    //         }
    //     }else{
    //         $gtt = $this->repository->with(['institute', 'qualification', 'education'])->find($search);
    //         $nilai_bayar = 0;
    //         if ($gtt->position->position_category_id == 1) {
    //             $nilai_bayar = 900000;
    //         } else {
    //             $nilai_bayar = 500000;
    //         };
    //         $response =[
    //             "nilai_bayar" => $gtt->education->qualification->incentive,
    //             "gtt" => $gtt
    //         ];
    //     }
    //     if (request()->is('api*') || request()->ajax()) {
    //         return response()->json($response);
    //     }

    // }
    public function search()
    {
        $search = request()->search;
        // $search = request()->nik;

        $response = array();
        $gtts=$this->gttRepository->scopeQuery(function ($query) use($search){
                return $query->whereNotIn('id',function ($q){
                    return $q->select('nik
                    ')->from('gtt')->get();
                })->where('nik','LIKE','%'.$search.'%');

        })->all(['id','nik','full_name']);
        if ($gtts->count() > 0) {
            foreach ($gtts as $item) {
                    $response[] = array(
                        "id" => $item->id,
                        "text" => $item->nik,' | '.$item->full_name,
                    );
            }
        }
        if (request()->is('api*') || request()->ajax()) {
            return response()->json($response);
        }
    }
}
