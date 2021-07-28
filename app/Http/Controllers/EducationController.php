<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\EducationCreateRequest;
use App\Http\Requests\EducationUpdateRequest;
use App\Repositories\EducationRepository;
use App\Validators\EducationValidator;

/**
 * Class EducationController.
 *
 * @package namespace App\Http\Controllers;
 */
class EducationController extends Controller
{
    /**
     * @var EducationRepository
     */
    protected $repository;

    /**
     * @var EducationValidator
     */
    protected $validator;

    /**
     * EducationController constructor.
     *
     * @param EducationRepository $repository
     * @param EducationValidator $validator
     */
    public function __construct(EducationRepository $repository, EducationValidator $validator)
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
        $education = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $education,
            ]);
        }

        return view('education.index', compact('education'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EducationCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(EducationCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $education = $this->repository->create($request->all());

            $response = [
                'message' => 'Education created.',
                'data'    => $education->toArray(),
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
        $education = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $education,
            ]);
        }

        return view('education.show', compact('education'));
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
        $education = $this->repository->find($id);

        return view('education.edit', compact('education'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EducationUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(EducationUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $education = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Education updated.',
                'data'    => $education->toArray(),
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
                'message' => 'Education deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Education deleted.');
    }
}
