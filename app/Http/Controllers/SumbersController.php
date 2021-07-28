<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SumberCreateRequest;
use App\Http\Requests\SumberUpdateRequest;
use App\Repositories\SumberRepository;
use App\Validators\SumberValidator;

/**
 * Class SumbersController.
 *
 * @package namespace App\Http\Controllers;
 */
class SumbersController extends Controller
{
    /**
     * @var SumberRepository
     */
    protected $repository;

    /**
     * @var SumberValidator
     */
    protected $validator;

    /**
     * SumbersController constructor.
     *
     * @param SumberRepository $repository
     * @param SumberValidator $validator
     */
    public function __construct(SumberRepository $repository, SumberValidator $validator)
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->validator  = $validator;

        $this->modul = "sumber-anggaran";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $sumbers = $this->repository->all();
        $modul = $this->modul;

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $sumbers,
            ]);
        }

        return view('sumber.index', compact('sumbers', 'modul'));
    }


    public function create()
    {
        $modul = $this->modul;
        return view('sumber.create', compact('modul'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SumberCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SumberCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $sumber = $this->repository->create($request->all());

            $response = [
                'message' => 'Sumber created.',
                'data'    => $sumber->toArray(),
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
        $sumber = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $sumber,
            ]);
        }

        return view('sumbers.show', compact('sumber'));
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
        $modul = $this->modul;
        $sumber = $this->repository->find($id);

        return view('sumber.edit', compact('sumber', 'modul'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SumberUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SumberUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $sumber = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Sumber updated.',
                'data'    => $sumber->toArray(),
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
                'message' => 'Sumber deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Sumber deleted.');
    }
}
