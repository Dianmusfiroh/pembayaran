<?php

namespace App\Http\Controllers;

use App\Entities\Assesment;
use App\Entities\AssesmentOption;
use App\Entities\Jabatan;
use App\Entities\CandidateProfile;
use App\Entities\FormationNeeds;
use Illuminate\Http\Request;
use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AssesmentCreateRequest;
use App\Http\Requests\AssesmentUpdateRequest;
use App\Repositories\AssesmentFormRepository;
use App\Repositories\AssesmentOptionRepository;
use App\Repositories\AssesmentRepository;
use App\Repositories\AssessmentDetailRepository;
use App\Repositories\CandidateProfileRepository;
use App\Repositories\FormationRepository;
use App\Repositories\JabatanRepository;
use App\Repositories\SkDetailRepository;
use App\Repositories\SkRepository;
use App\Repositories\StatusRepository;
use App\User;
use App\Validators\AssesmentValidator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade as PDF;

/**
 * Class AssesmentsController.
 *
 * @package namespace App\Http\Controllers;
 */
class AssesmentsController extends Controller
{
    /**
     * @var AssesmentRepository
     */
    protected $repository;
    protected $kandidatRepo;
    protected $jabatanRepo;
    protected $assesmentOption;
    protected $skRepository;
    protected $statusRepository;
    protected $assessmentFormRepository;
    protected $assessmentDetail;
    protected $formationRepository;
    protected $skDetailRepository;
    /**
     * @var AssesmentValidator
     */
    protected $validator;

    /**
     * AssesmentsController constructor.
     *
     * @param AssesmentRepository $repository
     * @param AssesmentValidator $validator
     */
    public function __construct(AssesmentRepository $repository,
    AssesmentOptionRepository $assesmentOption,
    CandidateProfileRepository $kandidatRepo,
    JabatanRepository $jabatanRepo,
    AssesmentValidator $validator,
    SkRepository $skRepository,
    StatusRepository $statusRepository,
    AssesmentFormRepository $assesmentFormRepository,
    AssessmentDetailRepository $assessmentDetailRepository,
    FormationRepository $formationRepository,
    SkDetailRepository $skDetailRepository
    )
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->assesmentOption = $assesmentOption;
        $this->modul = 'penilaian';
        $this->jabatanRepo = $jabatanRepo;
        $this->kandidatRepo = $kandidatRepo;
        $this->skRepository = $skRepository;
        $this->statusRepository = $statusRepository;
        $this->assessmentFormRepository = $assesmentFormRepository;
        $this->assessmentDetail = $assessmentDetailRepository;
        $this->formationRepository = $formationRepository;
        $this->skDetailRepository = $skDetailRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kategori,$formation_category)
    {

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        
        if ($kategori == 'guru') {
            $kat_id = 1;
        } else {
            $kat_id = 2;
        }
        $assesments = $this->repository->scopeQuery(function($query) use($kat_id,$formation_category){
            return $query->addSelect(
                [
                    'full_name' => function($que){
                        $que->select('full_name')->from('candidate_profile')->whereColumn('user_id','assesment.candidate_id')->orderBy('id','desc')->limit(1);
                    },
                    'jabatan' => function($que){
                       $que->select('position.name')
                            ->from('formation')
                            ->join('formation_needs','formation.formation_needs_id','=', 'formation_needs.id')
                            ->join('position', 'formation_needs.position_id','=', 'position.id')
                            ->whereColumn('formation.id', 'assesment.formation_id')->orderBy('formation.id','desc')->limit(1);
                    },
                    'instansi' => function($que){
                        $que->select('institute.name')
                            ->from('formation')
                            ->join('formation_needs', 'formation.formation_needs_id', '=', 'formation_needs.id')
                            ->join('institute', 'formation_needs.institute_id', '=', 'institute.id')
                            ->whereColumn('formation.id', 'assesment.formation_id')->orderBy('formation.id', 'desc')->limit(1);
                    },
                    'status' => function($que){
                        $que->select('status.name')
                            ->from('formation')
                            ->join('status', 'formation.status_id', '=', 'status.id')
                            ->whereColumn('formation.id', 'assesment.formation_id')->orderBy('formation.id', 'desc')->limit(1);
                    },
                    'status_id' => function($que){
                        $que->select("status_id")
                            ->from('formation')
                            ->whereColumn('formation.id', 'assesment.formation_id')->orderBy('formation.id', 'desc')->limit(1);
                    }
                    
                ])->whereIn('formation_id',function($q) use($kat_id,$formation_category){
                    $q->select('id')->from('formation')->whereIn('formation_needs_id',function($qf) use($kat_id,$formation_category){
                        $qf->select('id')->from('formation_needs')->whereIn('position_id', function ($q) use ($kat_id) {
                            $q->select('id')->from('position')->wherePositionCategoryId($kat_id);
                        })->where('formation_category_id',function($qq) use($formation_category){
                            $qq->select('id')->from('formation_category')->whereSlug($formation_category)->get();
                        })->orderBy('id','asc');
                    });
            })->orderBy('score', 'desc');
        })->all();
        // dd($assesments);
        // $assesments = Assesment::addSelect([''])->get();
        $statuses = $this->statusRepository->findWhereIn('id',['7','8']);
        $modul = $this->modul;

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $assesments,
            ]);
        }
        return view('assesment.index', compact('assesments','modul','statuses','kategori','formation_category','kat_id'));
    }
    public function create($kategori,$formation_category)
    {
        if ($kategori == 'guru') {
            $kat_id = 1;
        } else {
            $kat_id = 2;
        }
        $modul = $this->modul;
        $options = $this->assessmentFormRepository->scopeQuery(function($q) use($kat_id,$formation_category){
            return $q->where('formation_category_id',function($qq) use($formation_category){
                $qq->select('id')->from('formation_category')->whereSlug($formation_category);
            })->wherePositionCategoryId($kat_id);
        })->all();
        $arr_opsi = [];
        if ($options->count() > 0) {
            foreach ($options as $option) {
                $arr_opsi[] = [
                    'option_name' => $option->assessment_option->name,
                    'option_id' => $option->assessment_option->id,
                    'option_detail' => $option->assessment_option->assesment_score
                ];
            }
        }

        return view('assesment.create', compact('modul','arr_opsi','kategori','kat_id','formation_category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AssesmentCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(AssesmentCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $input = $request->all();
            // dd($input);
            $detail_data = [];
            $input['assessment_date'] = Carbon::now()->format('Y-m-d');
            $input['assessor_id'] = Auth::user()->id;
            $assesment = $this->repository->create($input);
            if ($request->has('option_name')) {
                for ($i = 0; $i < count($request->option_name); $i++) {
                    $option_detail_description = 'option_detail_description'. $request->option_name[$i];
                    $option_detail_score = 'option_detail_score' . $request->option_name[$i];
                    $assesment_score_ids = $request->$option_detail_description;
                    if (is_array($assesment_score_ids)){
                        for ($j=0; $j < count($assesment_score_ids); $j++) {
                            $scores = $option_detail_score.'_'. $assesment_score_ids[$j];
                            $detail_data = $scores;
                            for ($k=0; $k < count($request->$scores); $k++) {
                                $detail_data = [
                                    'assesment_id' => $assesment->id,
                                    'assessment_option_id' => $request->option_name[$i],
                                    'assessment_score_id' => $request->$option_detail_description[$j],
                                    'score' => $request->$option_detail_description[$j] == 4 ? 1 : 2,
                                    'desription' => $request->$scores[$k]
                                ];
                                $this->assessmentDetail->create($detail_data);
                            } 
                        }
                    }else{
                        $option_detail_score = 'option_detail_score' . $request->option_name[$i].'_'. $request->$option_detail_description;
                        $detail_data = [
                            'assesment_id' => $assesment->id,
                            'assessment_option_id' => $request->option_name[$i],
                            'assessment_score_id' => $request->$option_detail_description,
                            'score' => $request->$option_detail_score,
                            'desription' => ''
                        ];
                        $this->assessmentDetail->create($detail_data);
                    }
                    // $input['assessment_option_id'] = $request->assessment_option[$i];
                    // $input['assessor_id'] = Auth::user()->id;
                    // $assesment = $this->repository->create($input);
                }
            }
            if ($request->has('status')){
                $this->formationRepository->update(['status_id'=>$request->status],$request->formation_id);
            }
            // dd($detail_data);
            $response = [
                'message' => 'Assesment created.',
                'data'    => $assesment->toArray(),
            ];

            if ($request->is('api*')) {

                return response()->json($response);
            }
            Alert::success('Berhasil', 'Penilaian Berhasil Disimpan');
            return back();
        } catch (ValidatorException $e) {
            if ($request->is('api*')) {
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
        $assesment = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $assesment,
            ]);
        }

        return view('assesments.show', compact('assesment'));
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
        $assesment = $this->repository->find($id);

        $modul = $this->modul;
        $position = $this->jabatanRepo->all();
        $assesmentOption = $this->assesmentOption->all();
        $kandidat = $this->kandidatRepo->all();

        return view('assesment.edit', compact('assesment', 'modul', 'position', 'assesmentOption', 'kandidat'));
        // return view('assesment.edit', compact('assesment','modul','position','assesmentOption','kandidat','assesor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AssesmentUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(AssesmentUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $assesment = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Assesment updated.',
                'data'    => $assesment->toArray(),
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
            $cek_data = DB::select( DB::raw("SELECT * FROM gtt a JOIN sk_detail b ON a.id = b.gtt_id WHERE user_id='$cek->candidate_id'") );
            if (!empty($cek_data)){
                Alert::error('Gagal', 'Data tidak bisa dihapus karna sudah di SK');
                return back();
            }
            $this->formationRepository->update(['status_id'=>4],$cek->formation_id);
            $deleted = $this->repository->delete($id);

            if (request()->wantsJson()) {

                return response()->json([
                    'message' => 'Assesment deleted.',
                    'deleted' => $deleted,
                ]);
            }
            Alert::success('Berhasil', 'Penilaian Berhasil Dihapus');
            return back();
        }else{
            return redirect('/');
        }
    }

    public function download($kategori,$formation_category)
    {
        if ($kategori == 'guru') {
            $kat_id = 1;
        } else {
            $kat_id = 2;
        }
        $prints = $this->repository->scopeQuery(function ($query) use ($kat_id,$formation_category) {
            return $query->addSelect(
                [
                    'nik' => function ($que) {
                        $que->select('nik')->from('candidate_profile')->whereColumn('user_id', 'assesment.candidate_id')->orderBy('id', 'desc')->limit(1);
                    },
                    'full_name' => function ($que) {
                        $que->select('full_name')->from('candidate_profile')->whereColumn('user_id', 'assesment.candidate_id')->orderBy('id', 'desc')->limit(1);
                    },
                    'jabatan' => function ($que) {
                        $que->select('position.name')
                        ->from('formation')
                        ->join('formation_needs', 'formation.formation_needs_id', '=', 'formation_needs.id')
                        ->join('position', 'formation_needs.position_id', '=', 'position.id')
                        ->whereColumn('formation.id', 'assesment.formation_id')->orderBy('formation.id', 'desc')->limit(1);
                    },
                    'npsn' => function ($que) {
                        $que->select('institute.npsn')
                            ->from('formation')
                            ->join('formation_needs', 'formation.formation_needs_id', '=', 'formation_needs.id')
                            ->join('institute', 'formation_needs.institute_id', '=', 'institute.id')
                            ->whereColumn('formation.id', 'assesment.formation_id')->orderBy('formation.id', 'desc')->limit(1);
                    },
                    'instansi' => function ($que) {
                        $que->select('institute.name')
                        ->from('formation')
                        ->join('formation_needs', 'formation.formation_needs_id', '=', 'formation_needs.id')
                        ->join('institute', 'formation_needs.institute_id', '=', 'institute.id')
                        ->whereColumn('formation.id', 'assesment.formation_id')->orderBy('formation.id', 'desc')->limit(1);
                    },
                    'jenjang' => function ($que) {
                        $que->select('educational_stage.name')
                            ->from('formation')
                            ->join('formation_needs', 'formation.formation_needs_id', '=', 'formation_needs.id')
                            ->join('institute', 'formation_needs.institute_id', '=', 'institute.id')
                            ->join('educational_stage', 'institute.educational_stage_id', '=', 'educational_stage.id')
                            ->whereColumn('formation.id', 'assesment.formation_id')->orderBy('formation.id', 'desc')->limit(1);
                    },
                ]
            )->whereIn('formation_id', function ($q) use ($kat_id,$formation_category) {
                $q->select('id')->from('formation')->whereIn('formation_needs_id', function ($qf) use ($kat_id,$formation_category) {
                    $qf->select('id')->from('formation_needs')->whereIn('position_id', function ($q) use ($kat_id) {
                        $q->select('id')->from('position')->wherePositionCategoryId($kat_id);
                    })->where('formation_category_id', function ($qq) use ($formation_category) {
                        $qq->select('id')->from('formation_category')->whereSlug($formation_category)->get();
                    })->orderBy('id', 'asc');
                })->where('status_i',7);
            })->orderBy('score', 'desc');
        })->all();
        $pdf = PDF::loadview('assesment.print', compact('prints'))->setPaper('L', 'portrait');
        // return $pdf->download('lampiran_sk_' . $sk->no_sk . '.pdf');
        return $pdf->stream();
    }
}
