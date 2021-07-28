<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\OpsekolahCreateRequest;
use App\Http\Requests\OpsekolahUpdateRequest;
use App\Repositories\OpsekolahRepository;
use App\Validators\OpsekolahValidator;
use phpDocumentor\Reflection\Types\This;

/**
 * Class OpsekolahsController.
 *
 * @package namespace App\Http\Controllers;
 */
class OpsekolahsController extends Controller
{
    /**
     * @var OpsekolahRepository
     */
    protected $repository;
    protected $gttRepo;
    // use App\Repositories\GttRepository;
    /**
     * @var OpsekolahValidator
     */
    protected $validator;

    /**
     * OpsekolahsController constructor.
     *
     * @param OpsekolahRepository $repository
     * @param OpsekolahValidator $validator
     */
    public function __construct(OpsekolahRepository $repository, OpsekolahValidator $validator
    // GttRepository $gttRepo
)
    {
        $this->middleware('auth');
        // $this->gttRepo = $gttRepo;
        $this->repository = $repository;
        $this->validator  = $validator;
    $this->modul = 'gtt';
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
        $opsekolahs = $this->repository->all();
        $gtts = $this->repository->all();
        if (request()->wantsJson()) {

            return response()->json([
                'data' => $opsekolahs,
            ]);
        }

        return view('opsekolahs.index', compact('opsekolahs','gtts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OpsekolahCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(OpsekolahCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $opsekolah = $this->repository->create($request->all());

            $response = [
                'message' => 'Opsekolah created.',
                'data'    => $opsekolah->toArray(),
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
        $opsekolah = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $opsekolah,
            ]);
        }

        return view('opsekolahs.show', compact('opsekolah'));
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
        $opsekolah = $this->repository->find($id);

        return view('opsekolahs.edit', compact('opsekolah'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OpsekolahUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(OpsekolahUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $opsekolah = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Opsekolah updated.',
                'data'    => $opsekolah->toArray(),
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
                'message' => 'Opsekolah deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Opsekolah deleted.');
    }
}
