<?php

namespace App\Http\Controllers;

use App\Entities\Formation;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\FormationCreateRequest;
use App\Http\Requests\FormationUpdateRequest;
use App\Repositories\AssesmentFormRepository;
use App\Repositories\AssesmentRepository;
use App\Repositories\FormationNeedsRepository;
use App\Repositories\FormationRepository;
use App\User;
use App\Validators\FormationValidator;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * Class FormationsController.
 *
 * @package namespace App\Http\Controllers;
 */
class FormationsController extends Controller
{
    /**
     * @var FormationRepository
     */
    protected $repository;
    protected $formationNeedRepository;
    protected $assessmentFormRepository;
    protected $assesmentRepository;
    /**
     * @var FormationValidator
     */
    protected $validator;

    /**
     * FormationsController constructor.
     *
     * @param FormationRepository $repository
     * @param FormationValidator $validator
     */
    public function __construct(
        FormationRepository $repository,
        FormationValidator $validator,
        FormationNeedsRepository $formationNeedsRepository,
        AssesmentFormRepository $assesmentFormRepository,
        AssesmentRepository $assesmentRepository
    ) {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->formationNeedRepository = $formationNeedsRepository;
        $this->assessmentFormRepository = $assesmentFormRepository;
        $this->assesmentRepository = $assesmentRepository;
        $this->modul = 'peserta';
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
        $list = $this->repository->scopeQuery(function ($query) use ($kat_id,$formation_category) {
            return $query->addSelect([
                'nik' => function ($que) {
                    $que->select('nik')->from('candidate_profile')->whereColumn('user_id', 'formation.candidate_id')->orderBy('id')->limit(1);
                },
                'full_name' => function ($que) {
                    $que->select('full_name')->from('candidate_profile')->whereColumn('user_id', 'formation.candidate_id')->orderBy('id')->limit(1);
                },
                'instansi' => function ($que) {
                    $que->select('institute.name')
                        ->from('formation_needs')
                        ->join('institute', 'formation_needs.institute_id', '=', 'institute.id')
                        ->whereColumn('formation_needs.id', 'formation.formation_needs_id')->orderBy('formation_needs.id')->limit(1);
                },
                'jabatan' => function ($que) {
                    $que->select('position.name')
                        ->from('formation_needs')
                        ->join('position', 'formation_needs.position_id', '=', 'position.id')
                        ->whereColumn('formation_needs.id', 'formation.formation_needs_id')->orderBy('formation_needs.id')->limit(1);
                },
            ])->whereIn('formation_needs_id', function ($q) use ($kat_id,$formation_category) {
                $q->select('id')->from('formation_needs')->whereIn('position_id', function ($q) use ($kat_id) {
                    $q->select('id')->from('position')->wherePositionCategoryId($kat_id)->get();
                })->where('formation_category_id',function($qq) use($formation_category){
                    $qq->select('id')->from("formation_category")->whereSlug($formation_category)->get();
                })->get();
            })->orderBy('id');
        })->all();
        $modul = $this->modul;

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $list,
            ]);
        }

        return view('pendaftaran.index', compact('list', 'modul'));
    }

    public function create($job_id)
    {
        $formationNeed = $this->formationNeedRepository->find($job_id);
        $modul = 'Lamar ';
        return view('formasi.crete', compact('modul'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FormationCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(FormationCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $cek = $this->repository->findWhere(['candidate_id' => Auth::user()->id, 'formation_needs_id' => $request->formation_needs_id])->first();
            if ($cek) {
                Alert::info('Informasi', 'Anda telah terdaftar');
                return back();
            }

            $input = $request->all();
            $input['id'] = rand(0, 99999999);
            $input['status_id'] = 4;
            $input['candidate_id'] = Auth::user()->id;
            $formation = $this->repository->create($input);

            $response = [
                'message' => 'Formation created.',
                'data'    => $formation->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }
            Alert::success('Selamat', 'Anda telah berhasil mendaftar');
            return redirect('apps/bid/' . $formation->formation_needs_id . '/' . $formation->candidate_id . '/cetak-kartu');
            // return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            Alert::error('Gagal', $e->getMessageBag());
            return back();
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
        $formation = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $formation,
            ]);
        }

        return view('formations.show', compact('formation'));
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
        $formation = $this->repository->find($id);

        return view('formations.edit', compact('formation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FormationUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(FormationUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $formation = $this->repository->update($request->all(), $id);
            if ($request->has('nilai_test')){
                $this->assesmentRepository->update(['nilai_test'=>$request->nilai_test],$formation->assesment->id);
            }

            $response = [
                'message' => 'Formation updated.',
                'data'    => $formation->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }
            Alert::success('Berhasil', 'Berhasil Mengubah Status');
            return back();
            // return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            Alert::error('Gagal', 'Gagal Mengubah Status ' . $e->getMessageBag());
            return back();
            // return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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
        $cek = $this->assesmentRepository->whereFormationId($id)->first();
        if (!empty($cek)){
            Alert::error('Gagal', 'Pesrta tidak bisa dihapus karena sudah di nilai');
            return back();
        }
        
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Formation deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Formation deleted.');
    }

    public function search()
    {
        $search = request()->search;
        $kat_id = request()->item;
        $slug = request()->slug;

        $response = array();
        $arr_opsi = [];
        if (request()->searchFields != 'id:=') {
            if (request()->has('sk')) {
                $gtts = $this->repository->scopeQuery(function ($query) {
                    return $query->whereNotIn('candidate_id', function ($q) {
                        return $q->select('user_id')->from('gtt')->whereIn('id', function ($qq) {
                            return $qq->select('gtt_id')->from('sk_detail')->get();
                        })->get();
                    })->whereStatusId(7)->limit(10);
                })->all();
            } else {
                $gtts = $this->repository->scopeQuery(function ($query) use($kat_id,$slug) {
                    return $query->whereNotIn('candidate_id', function ($q) {
                        $q->select('candidate_id')->from('assesment')->get();
                    })->whereIN('formation_needs_id',function($q) use($kat_id,$slug){
                        $q->select('id')->from('formation_needs')->whereIn('position_id',function($qq) use($kat_id){
                            $qq->select('id')->from('position')->wherePositionCategoryId($kat_id);
                        })->where('formation_category_id',function($qq) use($slug){
                            $qq->select('id')->from('formation_category')->whereSlug($slug);
                        });
                    })->limit(10);
                })->all();
            }
            if ($gtts->count() > 0) {
                foreach ($gtts as $item) {
                    // $options = $this->assessmentFormRepository->findByField('position_category_id', $item->formation_needs->position->position_category_id);

                    // if ($options->count() > 0) {
                    //     foreach ($options as $option) {
                    //         $arr_opsi[] = [
                    //             'option_name' => $option->assessment_option->name,
                    //             'option_id' => $option->assessment_option->id,
                    //             'option_detail' => $option->assessment_option->assesment_score
                    //         ];
                    //     }
                    // }
                    if (request()->has('sk')) {
                        $response[] = array(
                            "id" => $item->candidate->id,
                            "text" => $item->candidate->candidateProfile->full_name,
                        );
                    } else {
                        $response[] = array(
                            "id" => $item->id,
                            "text" => $item->candidate ? $item->candidate->candidateProfile->full_name : '',
                            // "instansi" => $item->formation_needs->institute->name,
                            // "jabatan" => $item->formation_needs->position->name,
                            // "jabatan_id" => $item->formation_needs->position_id,
                            // "opsi" => $arr_opsi
                        );
                    }
                }
            }
        } else {
            $gtt = $this->repository->find($search);
            // $options = $this->assessmentFormRepository->findByField('position_category_id', $gtt->formation_needs->position->position_category_id);

            // if ($options->count() > 0) {
            //     foreach ($options as $option) {
            //         $arr_opsi[] = [
            //             'option_name' => $option->assessment_option->name,
            //             'option_id' => $option->assessment_option->id,
            //             'option_detail' => $option->assessment_option->assesment_score
            //         ];
            //     }
            // }
            $candidate = User::find($gtt->candidate_id);
            $response[] = array(
                "id" => $gtt->id,
                "text" =>  $candidate->candidateProfile->full_name,
                "instansi" => $gtt->formation_needs->institute->name,
                "jabatan" => $gtt->formation_needs->position->name,
                "jabatan_id" => $gtt->formation_needs->position_id,
                "candidate_id" => $gtt->candidate_id,
                "education" => $candidate->education->qualification->name,
                "program_studi" => $candidate->education->study_program->name
                // "opsi" => $arr_opsi,
                // "gtt" => $gtt,
                // "options" => $options
            );
        }
        if (request()->is('api*') || request()->ajax()) {
            return response()->json($response);
        }
    }

    public function kartu($need_id, $candidate_id)
    {
        $formation = $this->repository->findWhere(['formation_needs_id' => $need_id, 'candidate_id' => $candidate_id])->first();
        // dd($formation);
        $pdf = PDF::loadview('pendaftaran.kartu', compact('formation'))->setPaper('A4', 'portrait');
        // return $pdf->stream();
        return $pdf->download($formation->id . '_kartu_registrasi.pdf');
    }
}
