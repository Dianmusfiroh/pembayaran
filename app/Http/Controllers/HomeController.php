<?php

namespace App\Http\Controllers;

use App\RekapKecamatan;
use App\Repositories\FormationNeedsRepository;
use App\Repositories\FormationRepository;

use App\Repositories\CandidateProfileRepository;
use App\Repositories\EducationRepository;
use App\Repositories\GttRepository;
use App\Repositories\PaguRepository;
use App\Repositories\QualificationRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $formationNeedsRepository;
    protected $formationRepository;
    protected $kandidatRepository;
    protected $paguRepository;
    protected $gttRepository;
    protected $qualificationRepository;
    protected $educationRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        FormationNeedsRepository $formationNeedsRepository,
        FormationRepository $formationRepository,
        CandidateProfileRepository $kandidatRepository,
        QualificationRepository $qualificationRepository,
        GttRepository $gttRepository,
        EducationRepository $educationRepository,
        PaguRepository $paguRepository

    ) {
        $this->middleware('auth');
        $this->formationNeedsRepository = $formationNeedsRepository;
        $this->formationRepository = $formationRepository;
        $this->kandidatRepository = $kandidatRepository;
        $this->paguRepository = $paguRepository;
        $this->educationRepository = $educationRepository;
        $this->gttRepository = $gttRepository;
        $this->qualificationRepository = $qualificationRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $modul = 'Dashboard';

        $status_pendaftar = $this->formationRepository->findByField('candidate_id', Auth::user()->id)->first();
        // $realisasi_per_jenjang = DB::select(DB::raw("SELECT upper(jenjang) jenjang, SUM(jumlah_bayar) total FROM rekap_kecamatan GROUP BY jenjang_id,jenjang,jumlah_bayar ORDER BY jenjang_id ASC"));
        $pagu = $this->paguRepository->findByField('year', date('Y'))->first();
        $realisasi_per_jenjang = RekapKecamatan::select(DB::raw("upper(jenjang) jenjang, SUM(jumlah_bayar) total"))->groupBy(['jenjang_id', 'jenjang', 'jumlah_bayar'])->orderBy('jenjang_id','ASC')->get();

        $prediksi = DB::table('gtt')
            ->leftJoin('qualification', 'gtt.qualification_id', '=', 'qualification.id')
            ->sum('qualification.incentive');

        return view('home', compact('modul', 'status_pendaftar', 'prediksi', 'pagu', 'realisasi_per_jenjang'));
    }

    public function information()
    {
        $formationNeeds = $this->formationNeedsRepository->findWhere([['start_date','<=',date('Y-m-d H:i:s')], ['end_date', '>=', date('Y-m-d H:i:s')]]);
        $nik = $this->kandidatRepository->findByField('user_id', Auth::user()->id)->first();


        $status_pendaftar = $this->formationRepository->findByField('candidate_id', Auth::user()->id)->first();
        return view('information_tabel', compact('formationNeeds', 'status_pendaftar', 'nik'));
    }


    public function information_detail($id)
    {
        $item = $this->formationNeedsRepository->find($id);
        $status_pendaftar = $this->formationRepository->findByField('candidate_id', Auth::user()->id)->first();
        return view('information',compact('item','status_pendaftar'));
    }

    public function dash_pendaftaran()
    {
        if (request()->ajax()){

            $data = DB::select(DB::raw('SELECT 
                    (SELECT COUNT(*) FROM users WHERE role_id =2 ) total_mendaftar,
                    COUNT(a.id) total_melamar,
                    CASE WHEN b.status_id=5 THEN COUNT(b.id) ELSE 0 END AS total_lulus_1,
                    CASE WHEN b.status_id=6 THEN COUNT(b.id) ELSE 0 END AS total_tidak_lulus_1,
                    CASE WHEN b.status_id=7 THEN COUNT(b.id) ELSE 0 END AS total_lulus_2,
                    CASE WHEN b.status_id=8 THEN COUNT(b.id) ELSE 0 END AS total_tidak_lulus_2
                    FROM users a join formation b ON (a.id = b.candidate_id)
                    WHERE role_id = 2'));

            return response()->json([
                'message' => 'pesan',
                'data' => $data
            ]);
        }
        return back();
    }
}
