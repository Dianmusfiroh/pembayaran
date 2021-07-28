<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Entities\AssesmentOption;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AssesmentOptionCreateRequest;
use App\Http\Requests\AssesmentOptionUpdateRequest;
use App\Repositories\AssesmentOptionRepository;
use App\Validators\AssesmentOptionValidator;

/**
 * Class AssesmentOptionsController.
 *
 * @package namespace App\Http\Controllers;
 */
class AssesmentOptionsController extends Controller
{
    private $modul;
    /**
     * @var AssesmentOptionRepository
     */
    protected $repository;

    /**
     * @var AssesmentOptionValidator
     */
    protected $validator;

    /**
     * AssesmentOptionsController constructor.
     *
     * @param AssesmentOptionRepository $repository
     * @param AssesmentOptionValidator $validator
     */
    public function __construct(AssesmentOptionRepository $repository, AssesmentOptionValidator $validator)
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->modul = 'assesment-option';

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $assesmentOptions = $this->repository->all();
        $modul = $this->modul;

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $assesmentOptions,
            ]);
        }

return view('assesmentOption.index', compact('assesmentOptions','modul'));
    }
    public function create()
    {
        $modul = $this->modul;
        return view('assesmentOption.create',compact('modul'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AssesmentOptionCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(AssesmentOptionCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $assesmentOption = $this->repository->create($request->all());

            $response = [
                'message' => 'AssesmentOption created.',
                'data'    => $assesmentOption->toArray(),
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
        $assesmentOption = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $assesmentOption,
            ]);
        }

        return view('assesmentOptions.show', compact('assesmentOption'));
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
        $assesmentOption = $this->repository->find($id);
        $modul = $this->modul;
        return view('assesmentOption.edit', compact('assesmentOption','modul'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AssesmentOptionUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(AssesmentOptionUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $assesmentOption = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'AssesmentOption updated.',
                'data'    => $assesmentOption->toArray(),
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
                'message' => 'AssesmentOption deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'AssesmentOption deleted.');
    }
}
