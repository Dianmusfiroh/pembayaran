<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\BankAccountCreateRequest;
use App\Http\Requests\BankAccountUpdateRequest;
use App\Repositories\BankAccountRepository;
use App\Validators\BankAccountValidator;

/**
 * Class BankAccountsController.
 *
 * @package namespace App\Http\Controllers;
 */
class BankAccountsController extends Controller
{
    /**
     * @var BankAccountRepository
     */
    protected $repository;

    /**
     * @var BankAccountValidator
     */
    protected $validator;

    /**
     * BankAccountsController constructor.
     *
     * @param BankAccountRepository $repository
     * @param BankAccountValidator $validator
     */
    public function __construct(BankAccountRepository $repository, BankAccountValidator $validator)
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
        $bankAccounts = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $bankAccounts,
            ]);
        }

        return view('bankAccounts.index', compact('bankAccounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BankAccountCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BankAccountCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $bankAccount = $this->repository->create($request->all());

            $response = [
                'message' => 'BankAccount created.',
                'data'    => $bankAccount->toArray(),
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
        $bankAccount = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $bankAccount,
            ]);
        }

        return view('bankAccounts.show', compact('bankAccount'));
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
        $bankAccount = $this->repository->find($id);

        return view('bankAccounts.edit', compact('bankAccount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BankAccountUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BankAccountUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $bankAccount = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'BankAccount updated.',
                'data'    => $bankAccount->toArray(),
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
                'message' => 'BankAccount deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'BankAccount deleted.');
    }
}
