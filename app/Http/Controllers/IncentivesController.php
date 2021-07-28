<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\IncentiveCreateRequest;
use App\Http\Requests\IncentiveUpdateRequest;
use App\Repositories\IncentiveRepository;
use App\Validators\IncentiveValidator;

/**
 * Class IncentivesController.
 *
 * @package namespace App\Http\Controllers;
 */
class IncentivesController extends Controller
{
    /**
     * @var IncentiveRepository
     */
    protected $repository;

    /**
     * @var IncentiveValidator
     */
    protected $validator;

    /**
     * IncentivesController constructor.
     *
     * @param IncentiveRepository $repository
     * @param IncentiveValidator $validator
     */
    public function __construct(IncentiveRepository $repository, IncentiveValidator $validator)
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
        $incentives = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $incentives,
            ]);
        }

        return view('incentives.index', compact('incentives'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  IncentiveCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(IncentiveCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $incentive = $this->repository->create($request->all());

            $response = [
                'message' => 'Incentive created.',
                'data'    => $incentive->toArray(),
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
        $incentive = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $incentive,
            ]);
        }

        return view('incentives.show', compact('incentive'));
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
        $incentive = $this->repository->find($id);

        return view('incentives.edit', compact('incentive'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  IncentiveUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(IncentiveUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $incentive = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Incentive updated.',
                'data'    => $incentive->toArray(),
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
                'message' => 'Incentive deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Incentive deleted.');
    }
}
