<?php

namespace App\Http\Controllers;

use App\Entities\Province;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\KabupatenCreateRequest;
use App\Http\Requests\KabupatenUpdateRequest;
use App\Repositories\KabupatenRepository;
use App\Validators\KabupatenValidator;

/**
 * Class KabupatensController.
 *
 * @package namespace App\Http\Controllers;
 */
class KabupatensController extends Controller
{
    /**
     * @var KabupatenRepository
     */
    protected $repository;

    /**
     * @var KabupatenValidator
     */
    protected $validator;

    /**
     * KabupatensController constructor.
     *
     * @param KabupatenRepository $repository
     * @param KabupatenValidator $validator
     */
    public function __construct(KabupatenRepository $repository, KabupatenValidator $validator)
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->validator  = $validator;

        $this->modul = 'kabupaten';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $kabupatens = $this->repository->all();
        $modul = $this->modul;
        if (request()->wantsJson()) {

            return response()->json([
                'data' => $kabupatens,
            ]);
        }

        return view('wilayah.kabupatens.index', compact('kabupatens', 'modul'));
    }

    public function create()
    {
        $modul = $this->modul;
        $provinces = Province::all();
        return view('wilayah.kabupatens.create', compact('modul', 'provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  KabupatenCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(KabupatenCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $kabupaten = $this->repository->create($request->all());

            $response = [
                'message' => 'Kabupaten created.',
                'data'    => $kabupaten->toArray(),
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
        $kabupaten = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $kabupaten,
            ]);
        }

        return view('kabupatens.show', compact('kabupaten'));
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
        $kabupaten = $this->repository->find($id);
        $modul = $this->modul;
        $provinces = Province::all();

        return view('wilayah.kabupatens.edit', compact('kabupaten', 'modul', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  KabupatenUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(KabupatenUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $kabupaten = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Kabupaten updated.',
                'data'    => $kabupaten->toArray(),
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
                'message' => 'Kabupaten deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Kabupaten deleted.');
    }
}
