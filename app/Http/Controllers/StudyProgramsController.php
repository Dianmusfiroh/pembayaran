<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\StudyProgramCreateRequest;
use App\Http\Requests\StudyProgramUpdateRequest;
use App\Repositories\StudyProgramRepository;
use App\Validators\StudyProgramValidator;

/**
 * Class StudyProgramsController.
 *
 * @package namespace App\Http\Controllers;
 */
class StudyProgramsController extends Controller
{
    /**
     * @var StudyProgramRepository
     */
    protected $repository;

    /**
     * @var StudyProgramValidator
     */
    protected $validator;

    /**
     * StudyProgramsController constructor.
     *
     * @param StudyProgramRepository $repository
     * @param StudyProgramValidator $validator
     */
    public function __construct(StudyProgramRepository $repository, StudyProgramValidator $validator)
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $studyPrograms = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $studyPrograms,
            ]);
        }

        return view('studyPrograms.index', compact('studyPrograms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StudyProgramCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(StudyProgramCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $studyProgram = $this->repository->create($request->all());

            $response = [
                'message' => 'StudyProgram created.',
                'data'    => $studyProgram->toArray(),
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
        $studyProgram = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $studyProgram,
            ]);
        }

        return view('studyPrograms.show', compact('studyProgram'));
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
        $studyProgram = $this->repository->find($id);

        return view('studyPrograms.edit', compact('studyProgram'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StudyProgramUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(StudyProgramUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $studyProgram = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'StudyProgram updated.',
                'data'    => $studyProgram->toArray(),
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
                'message' => 'StudyProgram deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'StudyProgram deleted.');
    }
}
