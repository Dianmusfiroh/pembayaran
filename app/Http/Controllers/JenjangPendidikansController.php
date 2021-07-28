<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\JenjangPendidikanCreateRequest;
use App\Http\Requests\JenjangPendidikanUpdateRequest;
use App\Repositories\JenjangPendidikanRepository;
use App\Validators\JenjangPendidikanValidator;

/**
 * Class JenjangPendidikansController.
 *
 * @package namespace App\Http\Controllers;
 */
class JenjangPendidikansController extends Controller
{
    /**
     * @var JenjangPendidikanRepository
     */
    protected $repository;

    /**
     * @var JenjangPendidikanValidator
     */
    protected $validator;

    /**
     * JenjangPendidikansController constructor.
     *
     * @param JenjangPendidikanRepository $repository
     * @param JenjangPendidikanValidator $validator
     */
    public function __construct(JenjangPendidikanRepository $repository, JenjangPendidikanValidator $validator)
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
        $jenjangPendidikans = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $jenjangPendidikans,
            ]);
        }

        return view('jenjangPendidikans.index', compact('jenjangPendidikans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  JenjangPendidikanCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(JenjangPendidikanCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $jenjangPendidikan = $this->repository->create($request->all());

            $response = [
                'message' => 'JenjangPendidikan created.',
                'data'    => $jenjangPendidikan->toArray(),
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
        $jenjangPendidikan = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $jenjangPendidikan,
            ]);
        }

        return view('jenjangPendidikans.show', compact('jenjangPendidikan'));
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
        $jenjangPendidikan = $this->repository->find($id);

        return view('jenjangPendidikans.edit', compact('jenjangPendidikan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  JenjangPendidikanUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(JenjangPendidikanUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $jenjangPendidikan = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'JenjangPendidikan updated.',
                'data'    => $jenjangPendidikan->toArray(),
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
                'message' => 'JenjangPendidikan deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'JenjangPendidikan deleted.');
    }
}
