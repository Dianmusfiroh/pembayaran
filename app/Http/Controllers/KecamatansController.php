<?php

namespace App\Http\Controllers;

use App\Entities\Kabupaten;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\KecamatanCreateRequest;
use App\Http\Requests\KecamatanUpdateRequest;
use App\Repositories\KecamatanRepository;
use App\Validators\KecamatanValidator;

/**
 * Class KecamatansController.
 *
 * @package namespace App\Http\Controllers;
 */
class KecamatansController extends Controller
{
    /**
     * @var KecamatanRepository
     */
    protected $repository;

    /**
     * @var KecamatanValidator
     */
    protected $validator;

    /**
     * KecamatansController constructor.
     *
     * @param KecamatanRepository $repository
     * @param KecamatanValidator $validator
     */
    public function __construct(KecamatanRepository $repository, KecamatanValidator $validator)
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->validator  = $validator;


        $this->modul = 'kecamatan';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $kecamatans = $this->repository->all();
        $modul = $this->modul;

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $kecamatans,
            ]);
        }

        return view('wilayah.kecamatans.index', compact('kecamatans', 'modul'));
    }

    public function create()
    {
        $modul = $this->modul;
        $districts = Kabupaten::all();
        return view('wilayah.kecamatans.create', compact('modul', 'districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  KecamatanCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(KecamatanCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $kecamatan = $this->repository->create($request->all());

            $response = [
                'message' => 'Kecamatan created.',
                'data'    => $kecamatan->toArray(),
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
        $kecamatan = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $kecamatan,
            ]);
        }

        return view('kecamatans.show', compact('kecamatan'));
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
        $kecamatan = $this->repository->find($id);
        $modul = $this->modul;
        $districts = Kabupaten::all();
        return view('wilayah.kecamatans.edit', compact('kecamatan', 'modul', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  KecamatanUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(KecamatanUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $kecamatan = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Kecamatan updated.',
                'data'    => $kecamatan->toArray(),
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
                'message' => 'Kecamatan deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Kecamatan deleted.');
    }
}
