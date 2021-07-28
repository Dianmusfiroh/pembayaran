<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AssessmentDetailCreateRequest;
use App\Http\Requests\AssessmentDetailUpdateRequest;
use App\Repositories\AssessmentDetailRepository;
use App\Validators\AssessmentDetailValidator;

/**
 * Class AssessmentDetailsController.
 *
 * @package namespace App\Http\Controllers;
 */
class AssessmentDetailsController extends Controller
{
    /**
     * @var AssessmentDetailRepository
     */
    protected $repository;

    /**
     * @var AssessmentDetailValidator
     */
    protected $validator;

    /**
     * AssessmentDetailsController constructor.
     *
     * @param AssessmentDetailRepository $repository
     * @param AssessmentDetailValidator $validator
     */
    public function __construct(AssessmentDetailRepository $repository, AssessmentDetailValidator $validator)
    {
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
        $assessmentDetails = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $assessmentDetails,
            ]);
        }

        return view('assessmentDetails.index', compact('assessmentDetails'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AssessmentDetailCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(AssessmentDetailCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $assessmentDetail = $this->repository->create($request->all());

            $response = [
                'message' => 'AssessmentDetail created.',
                'data'    => $assessmentDetail->toArray(),
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
        $assessmentDetail = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $assessmentDetail,
            ]);
        }

        return view('assessmentDetails.show', compact('assessmentDetail'));
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
        $assessmentDetail = $this->repository->find($id);

        return view('assessmentDetails.edit', compact('assessmentDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AssessmentDetailUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(AssessmentDetailUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $assessmentDetail = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'AssessmentDetail updated.',
                'data'    => $assessmentDetail->toArray(),
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
                'message' => 'AssessmentDetail deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'AssessmentDetail deleted.');
    }
}
