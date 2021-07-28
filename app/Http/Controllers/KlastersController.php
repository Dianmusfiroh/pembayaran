<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\KlasterCreateRequest;
use App\Http\Requests\KlasterUpdateRequest;
use App\Repositories\KlasterRepository;
use App\Validators\KlasterValidator;

/**
 * Class KlastersController.
 *
 * @package namespace App\Http\Controllers;
 */
class KlastersController extends Controller
{
    /**
     * @var KlasterRepository
     */
    protected $repository;

    /**
     * @var KlasterValidator
     */
    protected $validator;

    /**
     * KlastersController constructor.
     *
     * @param KlasterRepository $repository
     * @param KlasterValidator $validator
     */
    public function __construct(KlasterRepository $repository, KlasterValidator $validator)
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
        $klasters = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $klasters,
            ]);
        }

        return view('klasters.index', compact('klasters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  KlasterCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(KlasterCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $klaster = $this->repository->create($request->all());

            $response = [
                'message' => 'Klaster created.',
                'data'    => $klaster->toArray(),
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
        $klaster = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $klaster,
            ]);
        }

        return view('klasters.show', compact('klaster'));
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
        $klaster = $this->repository->find($id);

        return view('klasters.edit', compact('klaster'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  KlasterUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(KlasterUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $klaster = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Klaster updated.',
                'data'    => $klaster->toArray(),
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
                'message' => 'Klaster deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Klaster deleted.');
    }
}
