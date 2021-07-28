<?php

namespace App\Http\Controllers;

use App\Entities\Jabatan;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\JabatanCreateRequest;
use App\Http\Requests\JabatanUpdateRequest;
use App\Repositories\JabatanRepository;
use App\Repositories\PositionCategoryRepository;
use App\Validators\JabatanValidator;
use Illuminate\Support\Facades\Auth;

/**
 * Class JabatansController.
 *
 * @package namespace App\Http\Controllers;
 */
class JabatansController extends Controller
{
    /**
     * @var JabatanRepository
     */
    protected $repository;
    protected $kategoriRepository;
    /**
     * @var JabatanValidator
     */
    protected $validator;

    /**
     * JabatansController constructor.
     *
     * @param JabatanRepository $repository
     * @param JabatanValidator $validator
     */
    public function __construct(JabatanRepository $repository, JabatanValidator $validator, PositionCategoryRepository $positionCategoryRepository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->kategoriRepository = $positionCategoryRepository;
        $this->validator  = $validator;

        $this->modul = 'jabatan';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $jabatans = $this->repository->all();
        $modul = $this->modul;

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $jabatans,
            ]);
        }

        return view('position.index', compact('jabatans', 'modul'));
    }

    public function create()
    {
        $modul = $this->modul;
        $kategori = $this->kategoriRepository->all();
        return view('position.create', compact('modul', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  JabatanCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(JabatanCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $input = $request->all();

            //inject author_id in request
            $input['author_id'] = Auth::user()->id;
            $jabatan = $this->repository->create($input);

            $response = [
                'message' => 'Jabatan created.',
                'data'    => $jabatan->toArray(),
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
        $jabatan = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $jabatan,
            ]);
        }

        return view('jabatans.show', compact('jabatan'));
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
        $jabatan = $this->repository->find($id);
        $modul = $this->modul;
        $kategori = $this->kategoriRepository->all();
        return view('position.edit', compact('jabatan', 'modul','kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  JabatanUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(JabatanUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $jabatan = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Jabatan updated.',
                'data'    => $jabatan->toArray(),
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
                'message' => 'Jabatan deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Jabatan deleted.');
    }
}
