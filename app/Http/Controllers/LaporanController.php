<?php

namespace App\Http\Controllers;

use App\Entities\Gtt;
use App\Repositories\CandidateProfileRepository;
use App\Repositories\GttRepository;
use App\Repositories\InvoiceRepository;
use App\Repositories\KecamatanRepository;
use App\Repositories\IncentiveRepository;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Svg\Tag\Group;

class LaporanController extends Controller
{
    protected $invoiceRepository;
    protected $kecamatanRepo;
    protected $gttRepo;
    protected $cpRepo;
    protected $incentiveRepo;

    public function __construct(
        InvoiceRepository $invoiceRepository,
        KecamatanRepository $kecamatanRepo,
        GttRepository $gttRepo,
        CandidateProfileRepository $cpRepo,
        IncentiveRepository $incentiveRepo
    ) {
        $this->middleware('auth');
        $this->invoiceRepository = $invoiceRepository;
        $this->kecamatanRepo = $kecamatanRepo;
        $this->gttRepo = $gttRepo;
        $this->cpRepo = $cpRepo;
        $this->incentiveRepo = $incentiveRepo;
    }

    public function rekapKecamatan()
    {
        // $detail = DB::select(DB::raw("SELECT kec.name kecamatan, DATE_FORMAT(inv.invoice_date,'%Y') tahun_anggaran, inv.step tahap, pc.name kategori,jenjang.name jenjang,jenjang.id jenjang_id,invp.period periode,invd.jumlah_bayar jumlah_bayar FROM invoice inv LEFT JOIN invoice_details invd ON (inv.id = invd.invoice_id) LEFT JOIN invoice_period invp ON (inv.id = invp.invoice_id) JOIN gtt ON (gtt.id = invd.gtt_id) LEFT JOIN institute sek ON (sek.id = gtt.institute_id) LEFT JOIN sub_districts kec ON (kec.id = sek.sub_districts_id) LEFT JOIN educational_stage jenjang ON (jenjang.id = sek.educational_stage_id) LEFT JOIN position p ON (p.id = gtt.position_id) LEFT JOIN position_categories pc ON (pc.id = p.position_category_id) "));
        $detail = DB::select(DB::raw("SELECT kec.name kecamatan, DATE_FORMAT(inv.invoice_date,'%Y') tahun_anggaran, inv.step tahap, COUNT(if(pc.name = 'guru', pc.name,NULL)) AS Guru, COUNT(IF(pc.name = 'tendik',pc.name,NULL)) AS tendik,jenjang.name jenjang,jenjang.id jenjang_id,invp.period periode,SUM(invd.jumlah_bayar) AS jumlah_bayar FROM invoice inv LEFT JOIN invoice_details invd ON (inv.id = invd.invoice_id) LEFT JOIN invoice_period invp ON (inv.id = invp.invoice_id) JOIN gtt ON (gtt.id = invd.gtt_id) LEFT JOIN institute sek ON (sek.id = gtt.institute_id) LEFT JOIN sub_districts kec ON (kec.id = sek.sub_districts_id) LEFT JOIN educational_stage jenjang ON (jenjang.id = sek.educational_stage_id) LEFT JOIN position p ON (p.id = gtt.position_id) LEFT JOIN position_categories pc ON (pc.id = p.position_category_id) GROUP BY kec.name "));

        // SELECT kec.name kecamatan, DATE_FORMAT(inv.invoice_date,'%Y') tahun_anggaran, inv.step tahap, pc.name kategori,jenjang.name jenjang,jenjang.id jenjang_id,invp.period periode,SUM(invd.jumlah_bayar) AS jumlah_bayar FROM invoice inv LEFT JOIN invoice_details invd ON (inv.id = invd.invoice_id) LEFT JOIN invoice_period invp ON (inv.id = invp.invoice_id) JOIN gtt ON (gtt.id = invd.gtt_id) LEFT JOIN institute sek ON (sek.id = gtt.institute_id) LEFT JOIN sub_districts kec ON (kec.id = sek.sub_districts_id) LEFT JOIN educational_stage jenjang ON (jenjang.id = sek.educational_stage_id) LEFT JOIN position p ON (p.id = gtt.position_id) LEFT JOIN position_categories pc ON (pc.id = p.position_category_id)
        // SELECT position_id  ,COUNT(pc.name)  FROM  gtt LEFT JOIN position p ON (p.id = gtt.position_id) LEFT JOIN position_categories pc ON (pc.id = p.position_category_id) GROUP BY pc.name
        // SELECT kec.name kecamatan, DATE_FORMAT(inv.invoice_date,'%Y') tahun_anggaran, inv.step tahap, COUNT(if(pc.name = 'guru', pc.name,NULL)) AS Guru, COUNT(IF(pc.name = 'tendik',pc.name,NULL)) AS tendik,jenjang.name jenjang,jenjang.id jenjang_id,invp.period periode,SUM(invd.jumlah_bayar) AS jumlah_bayar FROM invoice inv LEFT JOIN invoice_details invd ON (inv.id = invd.invoice_id) LEFT JOIN invoice_period invp ON (inv.id = invp.invoice_id) JOIN gtt ON (gtt.id = invd.gtt_id) LEFT JOIN institute sek ON (sek.id = gtt.institute_id) LEFT JOIN sub_districts kec ON (kec.id = sek.sub_districts_id) LEFT JOIN educational_stage jenjang ON (jenjang.id = sek.educational_stage_id) LEFT JOIN position p ON (p.id = gtt.position_id) LEFT JOIN position_categories pc ON (pc.id = p.position_category_id)
        // SELECT kec.name kecamatan, DATE_FORMAT(inv.invoice_date,'%Y') tahun_anggaran, inv.step tahap, COUNT(if(pc.name = 'guru', pc.name,NULL)) AS Guru, COUNT(IF(pc.name = 'tendik',pc.name,NULL)) AS tendik,jenjang.name jenjang,jenjang.id jenjang_id,invp.period periode,SUM(invd.jumlah_bayar) AS jumlah_bayar FROM invoice inv LEFT JOIN invoice_details invd ON (inv.id = invd.invoice_id) LEFT JOIN invoice_period invp ON (inv.id = invp.invoice_id) JOIN gtt ON (gtt.id = invd.gtt_id) LEFT JOIN institute sek ON (sek.id = gtt.institute_id) LEFT JOIN sub_districts kec ON (kec.id = sek.sub_districts_id) LEFT JOIN educational_stage jenjang ON (jenjang.id = sek.educational_stage_id) LEFT JOIN position p ON (p.id = gtt.position_id) LEFT JOIN position_categories pc ON (pc.id = p.position_category_id) GROUP BY kec.name
        $invoice = $this->invoiceRepository->all();
        $incentive = $this->incentiveRepo->all();
        // dd($invoice);
        // $detail = $this->invoiceRepository->scopeQuery(function ($query) {
        //     return $query->addSelect([
        //         'jumlah_bayar' => function ($que) {
        //             $que->select('jumlah_bayar')
        //                 ->from('invoice_detail')
        //                 ->join('gtt', 'invoice_detail.gtt_id', '=', 'gtt.id');
        //         },
        //         'kecamatan' => function ($que) {
        //             $que->select('name')
        //                 ->from('sub_districts')
        //                 ->join('institute', 'institute.sub_districts_id', '=', 'sub_district.id')
        //                 ->join('gtt', 'gtt.institute_id', '=', 'institute.id')
        //                 ->join('position', 'position.id', '=', 'gtt.position_id')
        //                 ->join('position_categories', 'position_categories.id', '=', 'position.position_category_id')
        //                 ->groupBy('sub_districts.name')
        //                 ->orderBy('position_categories.id');
        //         },
        //         'count' => function ($que) {
        //             $que->select(count('id'))
        //                 ->from('gtt');
        //         }
        //     ])->orderBy('kecamatan', 'asc');
        // });
        // dd($detail);

        // query = SELECT invoice_details.jumlah_bayar, sub_districts.name, COUNT(gtt.id) FROM `invoice_details` JOIN gtt JOIN institute JOIN sub_districts JOIN position JOIN position_categories ON invoice_details.gtt_id = gtt.id AND gtt.institute_id = institute.id AND institute.sub_districts_id = sub_districts.id AND gtt.position_id = position.id AND position.position_category_id = position_categories.id WHERE invoice_details.id = 'f8c8989f-b817-4575-9436-0d963a333031' GROUP BY sub_districts.name

        $modul = 'Laporan';
        return view('laporan.rekap_kecamatan', compact('modul', 'detail','incentive'));
        $data = $this->invoiceRepository->all();

        $prints = [];
        $pdf = PDF::loadview('laporan.print_rekap_kecamatan', compact('prints'))->setPaper('L', 'landscape');
        // return $pdf->download('laporan_pembayaran_rekap_kecamtan.pdf');
        return $pdf->stream();
    }

    public function rekapTotal()
    {
        $detail = DB::select(DB::raw("SELECT kab.name Kabupaten, DATE_FORMAT(inv.invoice_date,'%Y') tahun_anggaran, inv.step tahap, COUNT(if(pc.name = 'guru', pc.name,NULL)) AS Guru, COUNT(IF(pc.name = 'tendik',pc.name,NULL)) AS tendik,jenjang.name jenjang,jenjang.id jenjang_id,invp.period periode,SUM(invd.jumlah_bayar) AS jumlah_bayar FROM invoice inv LEFT JOIN invoice_details invd ON (inv.id = invd.invoice_id) LEFT JOIN invoice_period invp ON (inv.id = invp.invoice_id) JOIN gtt ON (gtt.id = invd.gtt_id) LEFT JOIN institute sek ON (sek.id = gtt.institute_id) LEFT JOIN districts kab ON (kab.id = sek.districts_id) LEFT JOIN educational_stage jenjang ON (jenjang.id = sek.educational_stage_id) LEFT JOIN position p ON (p.id = gtt.position_id) LEFT JOIN position_categories pc ON (pc.id = p.position_category_id) GROUP BY kab.name"));
        $invoice = $this->invoiceRepository->all();
        $incentive = $this->incentiveRepo->all();
        $modul = 'Laporan';
        return view('laporan.rekap_kabupaten', compact('modul', 'detail','incentive'));
        $data = $this->invoiceRepository->all();

        $prints = [];
        $pdf = PDF::loadview('laporan.print_rekap_kabupten', compact('prints'))->setPaper('L', 'landscape');
        return $pdf->stream();
    }
}
