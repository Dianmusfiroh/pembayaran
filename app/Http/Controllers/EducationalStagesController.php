<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\EducationalStageCreateRequest;
use App\Http\Requests\EducationalStageUpdateRequest;
use App\Repositories\EducationalStageRepository;
use App\Validators\EducationalStageValidator;

/**
 * Class EducationalStagesController.
 *
 * @package namespace App\Http\Controllers;
 */
class EducationalStagesController extends Controller
{
    /**
     * @var EducationalStageRepository
     */
    protected $repository;

    /**
     * @var EducationalStageValidator
     */
    protected $validator;

    /**
     * EducationalStagesController constructor.
     *
     * @param EducationalStageRepository $repository
     * @param EducationalStageValidator $validator
     */
    public function __construct(EducationalStageRepository $repository, EducationalStageValidator $validator)
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
        $educationalStages = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $educationalStages,
            ]);
        }

        return view('educationalStages.index', compact('educationalStages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EducationalStageCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(EducationalStageCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $educationalStage = $this->repository->create($request->all());

            $response = [
                'message' => 'EducationalStage created.',
                'data'    => $educationalStage->toArray(),
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
        $educationalStage = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $educationalStage,
            ]);
        }

        return view('educationalStages.show', compact('educationalStage'));
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
        $educationalStage = $this->repository->find($id);

        return view('educationalStages.edit', compact('educationalStage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EducationalStageUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(EducationalStageUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $educationalStage = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'EducationalStage updated.',
                'data'    => $educationalStage->toArray(),
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
                'message' => 'EducationalStage deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'EducationalStage deleted.');
    }
}
