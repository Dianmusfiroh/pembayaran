<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PaguCreateRequest;
use App\Http\Requests\PaguUpdateRequest;
use App\Repositories\PaguRepository;
use App\Repositories\SumberRepository;
use App\Validators\PaguValidator;

/**
 * Class PagusController.
 *
 * @package namespace App\Http\Controllers;
 */
class PagusController extends Controller
{
    protected $modul;
    /**
     * @var PaguRepository
     */
    protected $repository;
    protected $sumberAnggaranRepository;

    /**
     * @var PaguValidator
     */
    protected $validator;

    /**
     * PagusController constructor.
     *
     * @param PaguRepository $repository
     * @param PaguValidator $validator
     */
    public function __construct(PaguRepository $repository, PaguValidator $validator,SumberRepository $sumberRepository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->sumberAnggaranRepository = $sumberRepository;

        $this->modul = 'pagu';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $list = $this->repository->all();
        $modul ='pagu';

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $list,
            ]);
        }

        return view('pagu.index', compact('list','modul'));
    }

    public function create()
    {
        $modul = $this->modul;
        $sumbers = $this->sumberAnggaranRepository->all();

        return view('pagu.create',compact('modul','sumbers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PaguCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PaguCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $pagu = $this->repository->create($request->all());

            $response = [
                'message' => 'Pagu created.',
                'data'    => $pagu->toArray(),
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
        $pagu = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $pagu,
            ]);
        }

        return view('pagus.show', compact('pagu'));
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
        $pagu = $this->repository->find($id);
        $modul = $this->modul;
        $sumbers = $this->sumberAnggaranRepository->all();

        return view('pagu.edit',compact('modul','sumbers','pagu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PaguUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PaguUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $pagu = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Pagu updated.',
                'data'    => $pagu->toArray(),
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
                'message' => 'Pagu deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Pagu deleted.');
    }
}
