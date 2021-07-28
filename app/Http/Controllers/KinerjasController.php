<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Entities\Gtt;

use App\Entities\SkDetail;
use App\Entities\Kinerja;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\KinerjaCreateRequest;
use App\Http\Requests\KinerjaUpdateRequest;
use App\Repositories\KinerjaRepository;
use App\Validators\KinerjaValidator;
use App\Repositories\SkDetailRepository;
use App\Repositories\GttRepository;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Class KinerjasController.
 *
 * @package namespace App\Http\Controllers;
 */
class KinerjasController extends Controller
{
    /**
     * @var KinerjaRepository
     */
    protected $repository;
    protected $gttRepository;
    protected $skDetailRepository;


    /**
     * @var KinerjaValidator
     */
    protected $validator;

    /**
     * KinerjasController constructor.
     *
     * @param KinerjaRepository $repository
     * @param KinerjaValidator $validator
     */
    public function __construct(KinerjaRepository $repository,
    KinerjaValidator $validator,
    GttRepository $gttRepository,
    SkDetailRepository $skDetailRepository

    )
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->gttRepository = $gttRepository;
        $this->skDetailRepository = $skDetailRepository;

       $this->modul ='kinerja';
       $this->gtt = 'gtt';

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //    Auth::user()->institute_id;
       $d =  Auth::user()->institute_id;

    //    dd(Auth::user()->institute_id);
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        // $kinerjas = $this->repository->all();
        $kinerjas = DB::select(DB::raw("SELECT k.id id, g.nik nik, g.full_name nama,k.presentase presentase,k.month month,k.year year FROM kinerja k JOIN gtt g ON (g.id = k.gtt_id) JOIN institute i ON (i.id= g.institute_id) WHERE institute_id=$d"));
        $modul = $this->modul;
        if (request()->wantsJson()) {

            return response()->json([
                'data' => $kinerjas,
            ]);
        }

        return view('kinerja.index', compact('kinerjas','modul'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  KinerjaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function create()
    {
        $modul = $this->modul;

        return view('kinerja.create',compact('modul'));
    }
    public function store(KinerjaCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $kinerja = $this->repository->create($request->all());

            $response = [
                'message' => 'Kinerja created.',
                'data'    => $kinerja->toArray(),
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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kinerja = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $kinerja,
            ]);
        }

        return view('kinerja.show', compact('kinerja'));
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
        $kinerja = $this->repository->find($id);
        $modul = $this->modul;


        return view('kinerja.edit', compact('kinerja','modul'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  KinerjaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(KinerjaUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $kinerja = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Kinerja updated.',
                'data'    => $kinerja->toArray(),
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
                'message' => 'Kinerja deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Kinerja deleted.');
    }
    public function search()
    {
        $search = request()->search;
        // $search = request()->nik;

        $response = array();
        $gtts=$this->gttRepository->scopeQuery(function ($query) use($search){
                return $query->whereNotIn('id',function ($q){
                    return $q->select('nik')->from('gtt')->get();
                })->where('nik','LIKE','%'.$search.'%');

        })->all(['id','nik','full_name']);
        if ($gtts->count() > 0) {
            foreach ($gtts as $gtt) {
                    $response[] = array(
                        "id" => $gtt->id,
                        "text" => $gtt->nik,' | '.$gtt->full_name,
                    );
            }
        }
        if (request()->is('api*') || request()->ajax()) {
            return response()->json($response);
        }
    }
}
