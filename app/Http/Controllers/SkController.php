<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;


use App\Entities\Gtt;
use App\Entities\SkDetail;

use App\Http\Requests\SkCreateRequest;
use App\Http\Requests\SkUpdateRequest;
use App\Repositories\FormationRepository;
use App\Repositories\GttRepository;
use App\Repositories\SkRepository;
use App\Validators\SkValidator;
use App\Repositories\SkDetailRepository;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
/**
 * Class SksController.
 *
 * @package namespace App\Http\Controllers;
 */
class SkController extends Controller
{
    /**
     * @var SkRepository
     */
    protected $repository;
    protected $skDetailRepository;
    protected $formationRepository;
    protected $gttRepository;

    /**
     * @var SkValidator
     */
    protected $validator;

    /**
     * SksController constructor.
     *
     * @param SkRepository $repository
     * @param SkValidator $validator
     */
    public function __construct(
        SkRepository $repository,
        SkDetailRepository $skDetailRepository,
        SkValidator $validator,
        FormationRepository $formationRepository,
        GttRepository $gttRepository
    ) {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->skDetailRepository = $skDetailRepository;
        $this->validator  = $validator;
        $this->formationRepository = $formationRepository;
        $this->gttRepository = $gttRepository;
        $this->modul = 'sk';
        $this->gtt = 'gtt';
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
        $modul = 'sk';
        $gtt = $this->gtt;

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $list,
            ]);
        }

        return view('sk.index', compact('list', 'modul', 'gtt'));
    }

    public function create()
    {
        $modul = $this->modul;

        return view('sk.create', compact('modul'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SkCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SkCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $sk = $this->repository->create($request->all());

            $peserta = DB::select(DB::raw('SELECT
                                cp.*,i.id institute_id,q.id qualification_id,fn.position_id position_id
                            FROM
                                formation f
                                    JOIN candidate_profile cp ON (cp.user_id = f.candidate_id)
                                    JOIN formation_needs fn ON (fn.id = f.formation_needs_id)
                                    LEFT JOIN institute i ON (fn.institute_id = i.id)
                                    LEFT JOIN education e ON (e.user_id = f.candidate_id)
                                    LEFT JOIN qualification q ON (q.id = e.qualification_id)
                            WHERE
                                f.candidate_id NOT IN (SELECT
                                        user_id
                                    FROM
                                        gtt)
                                    AND f.status_id = 7'));
            if (!empty($peserta)){
                foreach ($peserta as $val) {
                    $insert_gtt = [
                        'nik' => $val->nik,
                        'nuptk' => $val->nuptk,
                        'full_name' => $val->full_name,
                        'title_ahead' => $val->title_ahead,
                        'back_title' => $val->back_title,
                        'date_of_birth' => $val->date_of_birth,
                        'place_of_birth' => $val->place_of_birth,
                        'tmt_start' => $val->tmt_start,
                        'tmt_end' => $val->tmt_start,
                        'jenis_kelamin' => $val->jenis_kelamin,
                        'user_id' => $val->user_id,
                        'institute_id' => $val->institute_id,
                        'qualification_id' => $val->qualification_id,
                        'position_id' => $val->position_id
                    ];
                    $gtt = $this->gttRepository->create($insert_gtt);
                    $this->skDetailRepository->create([
                        'sk_id' => $sk->id,
                        'gtt_id' => $gtt->id
                    ]);
                }
            }
            $response = [
                'message' => 'Sk created.',
                'data'    => $sk->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }
            Alert::success('Berhasil', 'Berhasil Membuat SK Dengan '.count($peserta).' Peserta');
            return back();
            // return redirect()->back()->with('message', $response['message']);
            // return redirect('apps/sk');
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            Alert::error('Gagal', $e->getMessageBag());
            return back();
            // return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */

    public function search()
    {
        $search = request()->search;
        // $search = request()->nik;

        $response = array();
        $gtts=$this->gttRepository->scopeQuery(function ($query) use($search){
                return $query->whereNotIn('id',function ($q){
                    return $q->select('gtt_id')->from('sk_detail')->get();
                })->where('nik','LIKE','%'.$search.'%');

        })->all(['id','nik','full_name']);
        // if ($gtts->count() > 0) {
            foreach ($gtts as $item) {
                    $response[] = array(
                        "id" => $item->id,
                        "text" => $item->nik,' | '.$item->full_name,
                    );
            }
        // }
        if (request()->is('api*') || request()->ajax()) {
            return response()->json($response);
        }
    }
    public function show($id)
    {
        $sk = $this->repository->find($id);
        $modul = $this->modul;

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $sk,
            ]);
        }

        return view('sk.show', compact('sk', 'modul'));
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
        $sk = $this->repository->find($id);
        $modul = $this->modul;

        return view('sk.edit', compact('sk', 'modul'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SkUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SkUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $sk = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Sk updated.',
                'data'    => $sk->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            // return redirect()->back()->with('message', $response['message']);
            return redirect('apps/sk');
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            Alert::error('Gagal', $e->getMessageBag());
            return back();
            // return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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
        // $gtt_id = SkDetail::whereSkId($id)->first('gtt_id');
        // $gtt_id = $gtt_id->gtt_id;

        // $deleted = Gtt::whereId($gtt_id)->delete();

        $deleted = SkDetail::whereSkId($id)->delete();

        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Sk deleted.',
                'deleted' => $deleted,
            ]);
        }
        Alert::success('Berhasil', 'Sk Berhasil Dihapus');
        return back();
        // return redirect()->back()->with('message', 'Sk deleted.');
    }

    public function gtt_view($id)
    {
        $sk = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $sk,
            ]);
        }

        return view('master.gtt', compact('sk'));
    }

    public function print($id)
    {
        $sk = $this->repository->find($id);
        $sk_detail = $this->skDetailRepository->scopeQuery(function ($query) {
            return $query->addSelect([
                'nama' => function ($que) {
                    $que->select('full_name')->from('gtt')->whereColumn('id', 'sk_detail.gtt_id')->orderBy('id')->limit('1');
                },
                'nik' => function ($que) {
                    $que->select('nik')->from('gtt')->whereColumn('id', 'sk_detail.gtt_id')->orderBy('id')->limit('1');
                },
                'nuptk' => function ($que) {
                    $que->select('nuptk')->from('gtt')->whereColumn('id', 'sk_detail.gtt_id')->orderBy('id')->limit('1');
                },
                'ttl' => function ($que) {
                    $que->select(DB::raw('CONCAT(place_of_birth,", ",DATE_FORMAT(date_of_birth,"%d %M %Y"))'))
                        ->from('gtt')
                        ->whereColumn('id', 'sk_detail.gtt_id')
                        ->orderBy('id')->limit('1');
                },
                'jenis_kelamin' => function ($que) {
                    $que->select('jenis_kelamin')->from('gtt')->whereColumn('id', 'sk_detail.gtt_id')->orderBy('id')->limit('1');
                },
                'instansi' => function ($que) {
                    $que->select('institute.name')
                        ->from('gtt')
                        ->join('institute', 'gtt.institute_id', '=', 'institute.id')
                        ->whereColumn('gtt.id', 'sk_detail.gtt_id')
                        ->orderBy('gtt.id')->limit('1');
                },
                'kecamatan' => function ($que) {
                    $que->select('sub_districts.name')
                        ->from('gtt')
                        ->join('institute', 'gtt.institute_id', '=', 'institute.id')
                        ->join('sub_districts', 'institute.sub_districts_id', '=', 'sub_districts.id')
                        ->whereColumn('gtt.id', 'sk_detail.gtt_id')
                        ->orderBy('gtt.id')->limit('1');
                },
                'jenjang' => function ($que) {
                    $que->select('educational_stage.name')
                        ->from('gtt')
                        ->join('institute', 'gtt.institute_id', '=', 'institute.id')
                        ->join('educational_stage', 'institute.educational_stage_id', '=', 'educational_stage.id')
                        ->whereColumn('gtt.id', 'sk_detail.gtt_id')
                        ->orderBy('gtt.id')->limit('1');
                },
                'jabatan' => function ($que) {
                    $que->select('position.name')
                        ->from('gtt')
                        ->join('position', 'gtt.position_id', '=', 'position.id')
                        ->whereColumn('gtt.id', 'sk_detail.gtt_id')
                        ->orderBy('gtt.id')->limit('1');
                },
                'pendidikan_terakhir' => function ($que) {
                    $que->select('qualification.name')
                        ->from('gtt')
                        // ->join('education', 'gtt.user_id', '=', 'education.user_id')
                        ->join('qualification', 'qualification_id', '=', 'qualification.id')
                        // ->join('qualification', 'education.qualification_id', '=', 'qualification.id')
                        ->whereColumn('gtt.id', 'sk_detail.gtt_id')
                        ->orderBy('gtt.id')->limit('1');
                },
                'kategori' => function ($que) {
                    $que->select('cluster.name')
                        ->from('gtt')
                        ->join('institute', 'gtt.institute_id', '=', 'institute.id')
                        ->join('cluster', 'institute.cluster_id', '=', 'cluster.id')
                        ->whereColumn('gtt.id', 'sk_detail.gtt_id')
                        ->orderBy('gtt.id')->limit('1');
                },
            ])->orderBy('kecamatan', 'asc');
        })->findWhere(['sk_id' => $sk->id]);
        $kecamatans = [];
        $prints = [];
        if ($sk_detail->count() > 0) {
            foreach ($sk_detail as $item) {
                if (!in_array(strtoupper($item->kecamatan), $kecamatans)) {
                    array_push($kecamatans, strtoupper($item->kecamatan));
                }
            }
            foreach ($kecamatans as $kecamatan) {
                $arr_detail = [];
                $jenjangs = [];
                foreach ($sk_detail as $item) {
                    if (strtoupper($item->kecamatan) == $kecamatan) {
                        if (!in_array(strtoupper($item->jenjang), $jenjangs)) {
                            array_push($jenjangs, strtoupper($item->jenjang));
                            $niks = [];
                            foreach ($sk_detail as $val) {
                                if (strtoupper($val->jenjang) == strtoupper($item->jenjang) && strtoupper($val->kecamatan) == $kecamatan) {
                                    if (!in_array($val->nik, $niks)) {
                                        array_push($niks, $val->nik);
                                        $arr_detail[strtoupper($val->jenjang)][] = [
                                            'nik' => $val->nik,
                                            'nuptk' => $val->nuptk,
                                            'nama' => $val->nama,
                                            'jenjang' => strtoupper($val->jenjang),
                                            'instansi' => $val->instansi,
                                            'ttl' => $val->ttl,
                                            'jenis_kelamin' => $val->jenis_kelamin ? 'Pria' : 'Wanita',
                                            'pendidikan_terakhir' => $val->pendidikan_terakhir,
                                            'jabatan' => $val->jabatan,
                                            'tmt_awal' => Carbon::parse($sk->start_date)->format('d M Y'),
                                            'kategori' => $val->kategori
                                        ];
                                    }
                                }
                            }
                        }
                    }
                }
                $prints[$kecamatan] = [
                    'lampiran' => 'KEPUTUSAN BUPATI GORONTALO UTARA',
                    'nomor' => $sk->no_sk,
                    'tanggal' => Carbon::parse($sk->created_at)->format('d M Y'),
                    'tentang' => 'PENGANGKATAN PENDIDIK DAN TENAGA KEPENDIDIKAN NON APARATUR SIPIL NEGARA TAHUN ' . date('Y'),
                    'sumber_dana' => 'APBD',
                    'jenjangs' => $arr_detail
                ];
            }
        }
        // dd($prints);
        $pdf = PDF::loadview('sk.print', compact('prints'))->setPaper('L', 'landscape');
        return $pdf->download('lampiran_sk_' . $sk->no_sk . '.pdf');
        // return $pdf->stream();

    }

    public function generatePeserta($id)

    // public function generatePeserta($sk_id)
    {
        // echo $id;

        $sk = $this->repository->find($id);
        $id = $sk->id;
        // $peserta = DB::select(DB::raw('SELECT
        //                         cp.*,i.id institute_id,q.id qualification_id,fn.position_id position_id
        //                     FROM
        //                         formation f
        //                             JOIN candidate_profile cp ON (cp.user_id = f.candidate_id)
        //                             JOIN formation_needs fn ON (fn.id = f.formation_needs_id)
        //                             LEFT JOIN institute i ON (fn.institute_id = i.id)
        //                             LEFT JOIN education e ON (e.user_id = f.candidate_id)
        //                             LEFT JOIN qualification q ON (q.id = e.qualification_id)
        //                     WHERE
        //                         f.candidate_id NOT IN (SELECT
        //                                 user_id
        //                             FROM
        //                                 gtt JOIN sk_detail ON gtt.id = sk_detail.gtt_id)
        //                             AND f.status_id = 7'));
    // $sk = $this->repository->find($id);
        $peserta = DB::select(DB::raw("SELECT IF(start_date +INTERVAL 1 day, no_sk+1, null) no_sk,start_date + INTERVAL 1 day start_date,end_date + INTERVAL 1 year end_date, COUNT(sd.gtt_id) AS jumlah_gtk FROM sk S JOIN sk_detail sd WHERE S.id = $id GROUP BY s.id"));
        if (!empty($peserta)) {

            foreach ($peserta as $val) {

                $insert_gtt = [
                    'no_sk' => $val->no_sk,
                    'start_date' => $val->start_date,
                    'end_date' => $val->end_date,
                    'jumlah_gtk' => $val->jumlah_gtk,

                ];

            }

                $sk = $this->repository->create($insert_gtt);
                // $this->repository->create([
                    // $this->skDetailRepository->create([
                    // 'sk_id' => $sk->id,

                    // 'jumlah_gtk'=> $sk->jumlah_gtk,
                    // 'gtt_id' => $sk->gtt_id
                // ]);
        // }
        Alert::success('Berhasil', 'Berhasil Menambahkan ' . count($peserta) . ' Peserta');
        return back();
}
    }
    }
