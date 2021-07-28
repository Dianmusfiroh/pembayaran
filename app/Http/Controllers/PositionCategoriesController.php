<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PositionCategoryCreateRequest;
use App\Http\Requests\PositionCategoryUpdateRequest;
use App\Repositories\PositionCategoryRepository;
use App\Validators\PositionCategoryValidator;

/**
 * Class PositionCategoriesController.
 *
 * @package namespace App\Http\Controllers;
 */
class PositionCategoriesController extends Controller
{
    /**
     * @var PositionCategoryRepository
     */
    protected $repository;

    /**
     * @var PositionCategoryValidator
     */
    protected $validator;

    /**
     * PositionCategoriesController constructor.
     *
     * @param PositionCategoryRepository $repository
     * @param PositionCategoryValidator $validator
     */
    public function __construct(PositionCategoryRepository $repository, PositionCategoryValidator $validator)
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
        $positionCategories = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $positionCategories,
            ]);
        }

        return view('positionCategories.index', compact('positionCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PositionCategoryCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PositionCategoryCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $positionCategory = $this->repository->create($request->all());

            $response = [
                'message' => 'PositionCategory created.',
                'data'    => $positionCategory->toArray(),
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
        $positionCategory = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $positionCategory,
            ]);
        }

        return view('positionCategories.show', compact('positionCategory'));
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
        $positionCategory = $this->repository->find($id);

        return view('positionCategories.edit', compact('positionCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PositionCategoryUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PositionCategoryUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $positionCategory = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'PositionCategory updated.',
                'data'    => $positionCategory->toArray(),
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
                'message' => 'PositionCategory deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'PositionCategory deleted.');
    }
}
