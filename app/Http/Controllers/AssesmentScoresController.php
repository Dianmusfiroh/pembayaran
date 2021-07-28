<?php

namespace App\Http\Controllers;

use App\Entities\AssesmentOption;
use App\Entities\AssesmentScore;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AssesmentScoreCreateRequest;
use App\Http\Requests\AssesmentScoreUpdateRequest;
use App\Repositories\AssesmentScoreRepository;
use App\Validators\AssesmentScoreValidator;

/**
 * Class AssesmentScoresController.
 *
 * @package namespace App\Http\Controllers;
 */
class AssesmentScoresController extends Controller
{
    /**
     * @var AssesmentScoreRepository
     */
    protected $repository;

    /**
     * @var AssesmentScoreValidator
     */
    protected $validator;

    /**
     * AssesmentScoresController constructor.
     *
     * @param AssesmentScoreRepository $repository
     * @param AssesmentScoreValidator $validator
     */
    public function __construct(AssesmentScoreRepository $repository, AssesmentScoreValidator $validator)
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->modul = 'assesment-score';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modul = $this->modul;
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $assesmentScores = $this->repository->all();
        $assesmentOption = AssesmentOption::all();

        // print_r($assesmentScores[0]);die;

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $assesmentScores,
            ]);
        }

        // dd($assesmentScores);
        return view('assesmentScore.index', compact('assesmentScores','modul','assesmentOption'));
    }

    public function create()
    {
        $modul = $this->modul;
        $assesmentOption = AssesmentOption::all();

        return view('assesmentScore.create',compact('modul','assesmentOption'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AssesmentScoreCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(AssesmentScoreCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $assesmentScore = $this->repository->create($request->all());

            $response = [
                'message' => 'AssesmentScore created.',
                'data'    => $assesmentScore->toArray(),
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
        $assesmentScore = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $assesmentScore,
            ]);
        }

        return view('assesmentScores.show', compact('assesmentScore'));
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
        $assesmentScore = $this->repository->find($id);
        $modul = $this->modul;
        $assesmentOption = AssesmentOption::all();

        return view('assesmentScore.edit', compact('assesmentScore','modul','assesmentOption'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AssesmentScoreUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(AssesmentScoreUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $assesmentScore = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'AssesmentScore updated.',
                'data'    => $assesmentScore->toArray(),
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
                'message' => 'AssesmentScore deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'AssesmentScore deleted.');
    }
}
