<?php

namespace App\Http\Controllers;

use App\Entities\AssesmentOption;
use App\Entities\Jabatan;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AssesmentFormCreateRequest;
use App\Http\Requests\AssesmentFormUpdateRequest;
use App\Repositories\AssesmentFormRepository;
use App\Repositories\AssesmentOptionRepository;
use App\Repositories\FormationCategoryRepository;
use App\Repositories\PositionCategoryRepository;
use App\Validators\AssesmentFormValidator;

/**
 * Class AssesmentFormsController.
 *
 * @package namespace App\Http\Controllers;
 */
class AssesmentFormsController extends Controller
{
    /**
     * @var AssesmentFormRepository
     */
    protected $repository;
    protected $positionCategoryRepository;
    protected $assesmentOptionRepository;
    protected $kategoriRepository;
    /**
     * @var AssesmentFormValidator
     */
    protected $validator;

    /**
     * AssesmentFormsController constructor.
     *
     * @param AssesmentFormRepository $repository
     * @param AssesmentFormValidator $validator
     */
    public function __construct(AssesmentFormRepository $repository, 
    AssesmentFormValidator $validator, 
    PositionCategoryRepository $positionCategoryRepository,
    AssesmentOptionRepository $assesmentOptionRepository,
    FormationCategoryRepository $formationCategoryRepository
    )
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->positionCategoryRepository = $positionCategoryRepository;
        $this->assesmentOptionRepository = $assesmentOptionRepository;
        $this->kategoriRepository = $formationCategoryRepository;
        $this->modul = 'assesment-form';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $assesmentForms = $this->repository->all();

        $modul = $this->modul;;
        if (request()->wantsJson()) {

            return response()->json([
                'data' => $assesmentForms,
            ]);
        }

        return view('assesmentForm.index', compact('assesmentForms', 'modul'));
    }

    public function create()
    {
        $modul = $this->modul;
        $jabatan = $this->positionCategoryRepository->all();
        $assesmentOption = $this->assesmentOptionRepository->all();
        $categories = $this->kategoriRepository->all();
        return view('assesmentForm.create', compact('modul', 'jabatan', 'assesmentOption','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AssesmentFormCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(AssesmentFormCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $opsi = $request->assessment_option;
            $input = $request->all();
            for ($i=0; $i < count($opsi); $i++) {
                $input['assessment_option_id'] = $opsi[$i];
                $assesmentForm = $this->repository->create($input);
            }

            $response = [
                'message' => 'AssesmentForm created.',
                'data'    => $assesmentForm->toArray(),
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
        $assesmentForm = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $assesmentForm,
            ]);
        }

        return view('assesmentForms.show', compact('assesmentForm'));
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
        // $assesmentForm = $this->repository->find($id);
        // $modul = $this->modul;
        // $jabatans = Jabatan::all();
        // $assesmentOption = AssesmentOption::all();

        $data = array(
            'assesmentForm' => $this->repository->find($id),
            'modul' => $this->modul,
            'jabatans' => Jabatan::all(),
            'assesmentOption' => AssesmentOption::all(),
            'categories' =>  $this->kategoriRepository->all()
        );

        return view('assesmentForm.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AssesmentFormUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(AssesmentFormUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $assesmentForm = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'AssesmentForm updated.',
                'data'    => $assesmentForm->toArray(),
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
                'message' => 'AssesmentForm deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'AssesmentForm deleted.');
    }
}
