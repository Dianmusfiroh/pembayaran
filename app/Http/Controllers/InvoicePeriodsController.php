<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InvoicePeriodCreateRequest;
use App\Http\Requests\InvoicePeriodUpdateRequest;
use App\Repositories\InvoicePeriodRepository;
use App\Validators\InvoicePeriodValidator;

/**
 * Class InvoicePeriodsController.
 *
 * @package namespace App\Http\Controllers;
 */
class InvoicePeriodsController extends Controller
{
    /**
     * @var InvoicePeriodRepository
     */
    protected $repository;

    /**
     * @var InvoicePeriodValidator
     */
    protected $validator;

    /**
     * InvoicePeriodsController constructor.
     *
     * @param InvoicePeriodRepository $repository
     * @param InvoicePeriodValidator $validator
     */
    public function __construct(InvoicePeriodRepository $repository, InvoicePeriodValidator $validator)
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
        $invoicePeriods = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $invoicePeriods,
            ]);
        }

        return view('invoicePeriods.index', compact('invoicePeriods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InvoicePeriodCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(InvoicePeriodCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $invoicePeriod = $this->repository->create($request->all());

            $response = [
                'message' => 'InvoicePeriod created.',
                'data'    => $invoicePeriod->toArray(),
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
        $invoicePeriod = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $invoicePeriod,
            ]);
        }

        return view('invoicePeriods.show', compact('invoicePeriod'));
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
        $invoicePeriod = $this->repository->find($id);

        return view('invoicePeriods.edit', compact('invoicePeriod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InvoicePeriodUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(InvoicePeriodUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $invoicePeriod = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'InvoicePeriod updated.',
                'data'    => $invoicePeriod->toArray(),
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
                'message' => 'InvoicePeriod deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'InvoicePeriod deleted.');
    }
}
