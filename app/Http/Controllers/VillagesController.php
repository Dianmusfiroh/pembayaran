<?php

namespace App\Http\Controllers;

use App\Entities\Kecamatan;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\VillagesCreateRequest;
use App\Http\Requests\VillagesUpdateRequest;
use App\Repositories\VillagesRepository;
use App\Validators\VillagesValidator;

/**
 * Class VillagesController.
 *
 * @package namespace App\Http\Controllers;
 */
class VillagesController extends Controller
{
    /**
     * @var VillagesRepository
     */
    protected $repository;

    /**
     * @var VillagesValidator
     */
    protected $validator;

    /**
     * VillagesController constructor.
     *
     * @param VillagesRepository $repository
     * @param VillagesValidator $validator
     */
    public function __construct(VillagesRepository $repository, VillagesValidator $validator)
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->validator  = $validator;


        $this->modul = 'desa';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $villages = $this->repository->all();
        $modul = $this->modul;

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $villages,
            ]);
        }

        return view('wilayah.village.index', compact('villages', 'modul'));
    }

    public function create()
    {
        $modul = $this->modul;
        $sub_districts = Kecamatan::all();
        return view('wilayah.village.create', compact('modul','sub_districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  VillagesCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(VillagesCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $village = $this->repository->create($request->all());

            $response = [
                'message' => 'Villages created.',
                'data'    => $village->toArray(),
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
        $village = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $village,
            ]);
        }

        return view('villages.show', compact('village'));
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
        $village = $this->repository->find($id);
        $modul = $this->modul;
        $sub_districts = Kecamatan::all();
        return view('wilayah.village.edit', compact('village','modul', 'sub_districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  VillagesUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(VillagesUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $village = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Villages updated.',
                'data'    => $village->toArray(),
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
                'message' => 'Villages deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Villages deleted.');
    }
}
