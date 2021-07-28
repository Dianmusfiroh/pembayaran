<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InvoiceCreateRequest;
use App\Http\Requests\InvoiceUpdateRequest;
use App\Repositories\InvoiceDetailRepository;
use App\Repositories\InvoicePeriodRepository;
use App\Repositories\InvoiceRepository;
use App\Repositories\KecamatanRepository;
use App\Repositories\SettingsRepository;
use App\Repositories\SkRepository;
use App\Repositories\StatusRepository;
use App\Validators\InvoiceValidator;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

/**
 * Class InvoicesController.
 *
 * @package namespace App\Http\Controllers;
 */
class InvoicesController extends Controller
{
    protected $modul;
    /**
     * @var InvoiceRepository
     */
    protected $repository;
    protected $invoicePeriodeRepository;
    protected $statusRepository;
    protected $kecamatanRepository;
    protected $invoiceDetailRepository;
    protected $settingRepository;

    /**
     * @var InvoiceValidator
     */
    protected $validator;

    /**
     * InvoicesController constructor.
     *
     * @param InvoiceRepository $repository
     * @param InvoiceValidator $validator
     */
    public function __construct(
        InvoiceRepository $repository,
        InvoiceValidator $validator,
        InvoicePeriodRepository $invoicePeriodRepository,
        StatusRepository $statusRepository,
        KecamatanRepository $kecamatanRepository,
        InvoiceDetailRepository $invoiceDetailRepository,
        SettingsRepository $settingsRepository
    ) {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->invoicePeriodeRepository = $invoicePeriodRepository;
        $this->statusRepository = $statusRepository;
        $this->kecamatanRepository = $kecamatanRepository;
        $this->invoiceDetailRepository = $invoiceDetailRepository;
        $this->settingRepository = $settingsRepository;
        $this->modul = 'tagihan';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $list = $this->repository->all();
        $kecamatans = $this->kecamatanRepository->all();
        $modul = $this->modul;
        if (request()->is('api*')) {

            return response()->json([
                'data' => $list,
            ]);
        }

        return view('invoices.index', compact('list', 'modul', 'kecamatans'));
    }

    public function create()
    {
        $modul = $this->modul;
        return view('invoices.create', compact('modul'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InvoiceCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(InvoiceCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $input = $request->all();
            $input['status_id'] = 1;
            $input['author_id'] = Auth::user()->id;
            $invoice = $this->repository->create($input);
            if ($request->has('periode_realisasi')) {
                foreach ($request->periode_realisasi as $item) {
                    $this->invoicePeriodeRepository->updateOrCreate([
                        'invoice_id' => $invoice->id,
                        'period' => $item
                    ]);
                }
            }

            $response = [
                'message' => 'Invoice created.',
                'data'    => $invoice->toArray(),
            ];

            if ($request->is('api*')) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->is('api*')) {
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
        $invoice = $this->repository->find($id);
        $modul = $this->modul;

        if (request()->is('api*')) {

            return response()->json([
                'data' => $invoice,
            ]);
        }

        return view('invoices.show', compact('invoice', 'modul'));
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
        $edit = $this->repository->find($id);
        $periods = $this->invoicePeriodeRepository->findWhere(['invoice_id' => $edit->id], ['period'])->map(function ($val) {
            return $val->period;
        })->toArray();
        $status = $this->statusRepository->findByField('status_for', 'INVOICE');
        $modul = $this->modul;

        return view('invoices.edit', compact('edit', 'modul', 'periods', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InvoiceUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(InvoiceUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $invoice = $this->repository->update($request->all(), $id);
            $this->invoicePeriodeRepository->deleteWhere(['invoice_id' => $id]);
            if ($request->has('periode_realisasi')) {
                foreach ($request->periode_realisasi as $item) {
                    $this->invoicePeriodeRepository->updateOrCreate([
                        'invoice_id' => $invoice->id,
                        'period' => $item
                    ]);
                }
            }

            $response = [
                'message' => 'Invoice updated.',
                'data'    => $invoice->toArray(),
            ];

            if ($request->is('api*')) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->is('api*')) {

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

        if (request()->is('api*')) {

            return response()->json([
                'message' => 'Invoice deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Invoice deleted.');
    }

    public function print($id)
    {
        $invoice = $this->repository->find(request()->id);
        $kpa['name'] = $this->settingRepository->findByField('label', 'kpa_name')->first()->nilai;
        $kpa['nip'] = $this->settingRepository->findByField('label', 'kpa_nip')->first()->nilai;
        $kpa['eselon'] = $this->settingRepository->findByField('label', 'kpa_eselon')->first()->nilai;
        $bendahara['nip'] = $this->settingRepository->findByField('label', 'nip_bendahara_pengeluaran')->first()->nilai;
        $bendahara['name'] = $this->settingRepository->findByField('label', 'nama_bendahara_pengeluaran')->first()->nilai;
        $invoiceDetails = $invoice->invoiceDetail;
        $arr_periode = [];
        foreach ($invoice->invoicePeriod as $ip) {
            // array_push($arr_periode, Carbon::create()->day(1)->month($ip->period)->format('F'));
            array_push($arr_periode, Carbon::now()->day(1)->month($ip->period)->format('F'));
        }

        $arr_jenjang = [];
        foreach ($invoiceDetails as $item) {
            $arr_jenjang[] = array_merge($arr_jenjang, [
                'id' => $item->gtt->institute->educational_stage_id,
                'name' => $item->gtt->institute->educational_stage->name
            ]);
        }
        $detail = [];
        $kecamatans = [];
        foreach ($invoiceDetails as $item) {
            $kecamatans[] = array_merge($kecamatans, [
                'id' => $item->gtt->institute->sub_districts->id,
                'name' => $item->gtt->institute->sub_districts->name
            ]);
        }

        if (!empty($kecamatans)) {
            foreach ($kecamatans as $kecamatan) {
                $arr_detail = [];
                $arr_jenjangs = [];
                $total_bayar = 0;
                foreach ($invoiceDetails as $item) {
                    if ($item->gtt->institute->sub_districts_id == $kecamatan['id']) {
                        $jenjang_name = $item->gtt->institute->educational_stage->name;
                        $jenjang_id = $item->gtt->institute->educational_stage->id;
                        if (!in_array($jenjang_name, $arr_jenjangs)) {
                            array_push($arr_jenjangs, $jenjang_name);
                            $niks = [];
                            foreach ($invoiceDetails as $item) {
                                if ($item->gtt->institute->educational_stage_id == $jenjang_id && $item->gtt->institute->sub_districts_id == $kecamatan['id']) {
                                    if (!in_array($item->gtt->nik, $niks)) {
                                        array_push($niks, $item->gtt->nik);
                                        $arr_detail[$jenjang_name][] = [
                                            'nik' => $item->gtt->nik,
                                            'nuptk' => $item->gtt->nuptk,
                                            'full_name' => $item->gtt->full_name,
                                            'jenjang' => strtoupper($item->gtt->institute->educational_stage->name),
                                            'instansi' => $item->gtt->institute->name,
                                            'nama_rek' => $item->gtt->account_name ,
                                            'no_rek' => $item->gtt->account_number ,
                                            'pendidikan_terakhir' => $item->gtt->qualification->name,
                                            'jabatan' => $item->gtt->position->name,
                                            'insentif' => number_format($item->gtt->qualification->incentive),
                                            'kinerja' => number_format($item->incentive->sum('kinerja')),
                                            // 'volume' => $item->incentive->count('volume'),
                                            'jumlah_bayar' => number_format($item->jumlah_bayar)
                                        ];
                                        $total_bayar += $item->jumlah_bayar;
                                    }
                                }
                            }
                        }
                    }
                }
                $detail[$kecamatan['name']] = [
                    'periode' => join(",", $arr_periode),
                    'tahap' => $invoice->step,
                    'jenjang' => $arr_detail,
                    'total_bayar' => number_format($total_bayar),
                    'kpa_name' => $kpa['name'],
                    'kpa_eselon' => $kpa['eselon'],
                    'kpa_nip' => $kpa['nip'],
                    'bendahara_name' => $bendahara['name'],
                    'bendahara_nip' => $bendahara['nip']
                ];
            }
        }
        // dd($detail);
        $pdf = PDF::loadview('invoices.print', compact('invoice', 'detail'))->setPaper('L', 'landscape');
        return $pdf->download('daftar_bayar_' . $invoice->no_spm . '.pdf');
        // return $pdf->stream();
    }
}
