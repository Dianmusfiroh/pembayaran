<?php

namespace App\Http\Controllers;

use App\Entities\FormationNeeds;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\FormationNeedsCreateRequest;
use App\Http\Requests\FormationNeedsUpdateRequest;
use App\Repositories\FormationCategoryRepository;
use App\Repositories\FormationNeedsRepository;
use App\Repositories\InstituteRepository;
use App\Repositories\JabatanRepository;
use App\Repositories\PositionCategoryRepository;
use App\Repositories\QualificationRepository;
use App\Validators\FormationNeedsValidator;

/**
 * Class FormationNeedsController.
 *
 * @package namespace App\Http\Controllers;
 */
class FormationNeedsController extends Controller
{
    /**
     * @var FormationNeedsRepository
     */
    protected $repository;
    protected $instituteRepo;
    protected $qualificationRepo;
    protected $positionRepo;
    protected $categoryRepository;
    protected $formationCategory;

    /**
     * @var FormationNeedsValidator
     */
    protected $validator;

    /**
     * FormationNeedsController constructor.
     *
     * @param FormationNeedsRepository $repository
     * @param FormationNeedsValidator $validator
     */
    public function __construct(
        FormationNeedsRepository $repository, 
        FormationNeedsValidator $validator, 
        InstituteRepository $instituteRepo, 
        QualificationRepository $qualificationRepo, 
        JabatanRepository $positionRepo,
        PositionCategoryRepository $positionCategoryRepository,
        FormationCategoryRepository $formationCategoryRepository
        )
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->validator  = $validator;

        $this->instituteRepo = $instituteRepo;
        $this->qualificationRepo = $qualificationRepo;
        $this->positionRepo = $positionRepo;
        $this->categoryRepository = $positionCategoryRepository;
        $this->formationCategory = $formationCategoryRepository;

        $this->modul = 'formasi';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kategori='',$position_category='')
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $formationNeeds = $this->repository->scopeQuery(function($query) use($kategori,$position_category){
            $subquery =  $query->addSelect([
                'instansi' => function($que){
                    $que->select('name')->from('institute')->whereColumn('id','formation_needs.institute_id')->limit(1);
                },
                'kualifikasi' => function ($que) {
                    $que->select('name')->from('qualification')->whereColumn('id', 'formation_needs.qualification_id')->limit(1);
                },
                'jabatan' => function ($que) {
                    $que->select('name')->from('position')->whereColumn('id', 'formation_needs.position_id')->limit(1);
                },
                // 'pendaftar' => function($que){
                //     $que->count('id')->from('formation')->whereColumn('formation_needs_id', 'formation_needs.id')->limit(1);
                // },
                // 'dinilai' => function ($que) {
                //     $que->select('assesment.id')->from('formation')
                //         ->join('assesment','formation.id','=','assesment.formation_id')
                //         ->whereColumn('formation_needs_id', 'formation_needs.id')
                //         ->count('id');
                // }
            ]);
            if ($position_category != ''){
                $subquery->whereIn('position_id',function($q) use($position_category){
                    $q->select('id')->from('position')->where('position_category_id',function($q) use($position_category){
                        $q->select('id')->from('position_categories')->where('name','like','%'.$position_category.'%')->limit(1);
                    });
                })->orderBy('start_date','DESC');
            }
            if ($kategori != '') {
                $subquery->where('formation_category_id', function ($qq) use ($kategori) {
                    $qq->select('id')->from('formation_category')->where('slug', $kategori)->first();
                });
            }
            return $subquery->orderBy('start_date','DESC');
        })->all();
        $modul = $this->modul;
        $total_kuota = $formationNeeds->sum('quantity');
        $title = strtoupper(str_replace('-',' ', $kategori)).' '.strtoupper($position_category);
        if (request()->is('api*')) {

            return response()->json([
                'data' => $formationNeeds,
            ]);
        }
        return view('formasi_need.index', compact('formationNeeds', 'modul','total_kuota','title','kategori','position_category'));
    }

    public function ByCategory($slug,$kategori='')
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $formationNeeds = $this->repository->scopeQuery(function ($query) use($slug,$kategori) {
            $subquery =  $query->addSelect([
                'instansi' => function ($que) {
                    $que->select('name')->from('institute')->whereColumn('id', 'formation_needs.institute_id')->limit(1);
                },
                'kualifikasi' => function ($que) {
                    $que->select('name')->from('qualification')->whereColumn('id', 'formation_needs.qualification_id')->limit(1);
                },
                'jabatan' => function ($que) {
                    $que->select('name')->from('position')->whereColumn('id', 'formation_needs.position_id')->limit(1);
                }
            ]);
            if ($kategori != '') {
                $subquery->whereIn('position_id', function ($q) use ($kategori) {
                    $q->select('id')->from('position')->where('position_category_id', function ($q) use ($kategori) {
                        $q->select('id')->from('position_categories')->where('name', 'like', '%' . $kategori . '%')->limit(1);
                    });
                })->orderBy('start_date', 'DESC');
            }
            $subquery->where('formation_category_id',function($qq) use($slug){
                $qq->select('id')->from('formation_category')->where('slug',$slug)->first();
            });
            return $subquery->orderBy('start_date', 'DESC');
        })->all();
        $modul = $this->modul;
        $total_kuota = $formationNeeds->sum('quantity');
        $title = strtoupper(str_replace('-', ' ', $slug));
        if (request()->is('api*')) {

            return response()->json([
                'data' => $formationNeeds,
            ]);
        }
        return view('formasi_need.index2', compact('formationNeeds', 'modul', 'total_kuota','title','slug','kategori'));
    }

    public function create()
    {
        $modul = $this->modul;
        $institute = $this->instituteRepo->all();
        $qualification = $this->qualificationRepo->all();
        $position = $this->positionRepo->all();
        $categories = $this->formationCategory->all();
        return view('formasi_need.create', compact('modul', 'qualification', 'position', 'institute','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FormationNeedsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(FormationNeedsCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            // return $request->all();
            // die;
            $formationNeed = $this->repository->create($request->all());

            $response = [
                'message' => 'FormationNeeds created.',
                'data'    => $formationNeed->toArray(),
            ];

            if ($request->is('api*')) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
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
    public function show($kat1,$kat2,$id)
    {
        // $formationNeed = $this->repository->find($id);
        $formationNeed = $this->repository->scopeQuery(function($query){
            $subquery =  $query->addSelect([
                'instansi' => function($que){
                    $que->select('name')->from('institute')->whereColumn('id','formation_needs.institute_id')->limit(1);
                },
                'kualifikasi' => function ($que) {
                    $que->select('name')->from('qualification')->whereColumn('id', 'formation_needs.qualification_id')->limit(1);
                },
                'jabatan' => function ($que) {
                    $que->select('name')->from('position')->whereColumn('id', 'formation_needs.position_id')->limit(1);
                },
            ]);
            return $subquery->orderBy('start_date','DESC');
        })->find($id);
        $modul = $this->modul;

        if (request()->is('api*')) {

            return response()->json([
                'data' => $formationNeed,
            ]);
        }

        return view('formasi_need.show', compact('formationNeed', 'modul'));
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
        $formationNeed = $this->repository->find($id);
        $institute = $this->instituteRepo->all();
        $qualification = $this->qualificationRepo->all();
        $position = $this->positionRepo->all();
        $categories = $this->formationCategory->all();
        $modul = $this->modul;
        // dd($formationNeed);
        // return $formationNeed;
        return view('formasi_need.edit', compact('formationNeed', 'modul', 'institute', 'qualification', 'position','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FormationNeedsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(FormationNeedsUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $formationNeed = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'FormationNeeds updated.',
                'data'    => $formationNeed->toArray(),
            ];

            if ($request->is('api*')) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
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

        if (request()->is('api*')) {

            return response()->json([
                'message' => 'FormationNeeds deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'FormationNeeds deleted.');
    }
}
