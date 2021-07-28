<?php

namespace App\Http\Controllers;

use App\Entities\Qualification;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\QualificationCreateRequest;
use App\Http\Requests\QualificationUpdateRequest;
use App\Repositories\QualificationRepository;
use App\Validators\QualificationValidator;

/**
 * Class QualificationsController.
 *
 * @package namespace App\Http\Controllers;
 */
class QualificationsController extends Controller
{
    /**
     * @var QualificationRepository
     */
    protected $repository;

    /**
     * @var QualificationValidator
     */
    protected $validator;

    /**
     * QualificationsController constructor.
     *
     * @param QualificationRepository $repository
     * @param QualificationValidator $validator
     */
    public function __construct(QualificationRepository $repository, QualificationValidator $validator)
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->validator  = $validator;

        $this->modul = 'qualifikasi';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $qualifications = $this->repository->all();
        $modul = $this->modul;

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $qualifications,
            ]);
        }

        return view('qualifikasi.index', compact('qualifications', 'modul'));
    }

    public function create()
    {
        $modul = $this->modul;
        $qualification = Qualification::all();
        return view('qualifikasi.create', compact('modul', 'qualification'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  QualificationCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(QualificationCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $qualification = $this->repository->create($request->all());

            $response = [
                'message' => 'Qualification created.',
                'data'    => $qualification->toArray(),
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
        $qualification = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $qualification,
            ]);
        }

        return view('qualifications.show', compact('qualification'));
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
        $qualification = $this->repository->find($id);
        $modul = $this->modul;

        return view('qualifikasi.edit', compact('qualification', 'modul'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  QualificationUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(QualificationUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $qualification = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Qualification updated.',
                'data'    => $qualification->toArray(),
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
                'message' => 'Qualification deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Qualification deleted.');
    }
}
