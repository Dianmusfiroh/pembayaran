<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CertificationCreateRequest;
use App\Http\Requests\CertificationUpdateRequest;
use App\Repositories\CertificationRepository;
use App\Validators\CertificationValidator;

/**
 * Class CertificationsController.
 *
 * @package namespace App\Http\Controllers;
 */
class CertificationsController extends Controller
{
    /**
     * @var CertificationRepository
     */
    protected $repository;

    /**
     * @var CertificationValidator
     */
    protected $validator;

    /**
     * CertificationsController constructor.
     *
     * @param CertificationRepository $repository
     * @param CertificationValidator $validator
     */
    public function __construct(CertificationRepository $repository, CertificationValidator $validator)
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
        $certifications = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $certifications,
            ]);
        }

        return view('certifications.index', compact('certifications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CertificationCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CertificationCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $certification = $this->repository->create($request->all());

            $response = [
                'message' => 'Certification created.',
                'data'    => $certification->toArray(),
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
        $certification = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $certification,
            ]);
        }

        return view('certifications.show', compact('certification'));
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
        $certification = $this->repository->find($id);

        return view('certifications.edit', compact('certification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CertificationUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CertificationUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $certification = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Certification updated.',
                'data'    => $certification->toArray(),
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
                'message' => 'Certification deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Certification deleted.');
    }
}
