<?php

namespace App\Http\Controllers;

use App\Entities\BankAccount;
use App\Entities\Gtt;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\BiodataCreateRequest;
use App\Http\Requests\BiodataUpdateRequest;
use App\Repositories\AddressRepository;
use App\Repositories\BankAccountRepository;
use App\Repositories\BiodataRepository;
use App\Repositories\CandidateProfileRepository;
use App\Repositories\CertificationRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\EducationRepository;
use App\Repositories\GttRepository;
use App\Repositories\InstituteRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\KabupatenRepository;
use App\Repositories\KecamatanRepository;
use App\Repositories\ProvinceRepository;
use App\Repositories\QualificationRepository;
use App\Repositories\StudyProgramRepository;
use App\Repositories\VillagesRepository;
use App\User;
use App\Validators\BiodataValidator;
use App\Validators\CandidateProfileValidator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * Class BiodatasController.
 *
 * @package namespace App\Http\Controllers;
 */
class BiodatasController extends Controller
{
    /**
     * @var BiodataRepository
     */
    protected $repository;
    protected $addressRepo;
    protected $userRepo;
    protected $certificationRepo;
    protected $provinceRepo;
    protected $kabupatenRepo;
    protected $kecamatanRepo;
    protected $desaRepo;
    protected $institutionRepo;
    protected $programStudyRepo;
    protected $departmentRepo;
    protected $educationRepo;
    protected $qualificationRepository;
    protected $bankAccount;
    protected $gtt;

    /**
     * @var BiodataValidator
     */
    protected $validator;

    /**
     * BiodatasController constructor.
     *
     * @param BiodataRepository $repository
     * @param BiodataValidator $validator
     */
    public function __construct(
        CandidateProfileRepository $repository,
        GttRepository $gttRepository,
        CandidateProfileValidator $validator,
        AddressRepository $addressRepository,
        CertificationRepository $certificationRepository,
        QualificationRepository $qualificationRepository,
        ProvinceRepository $provinceRepository,
        KabupatenRepository $kabupatenRepository,
        KecamatanRepository $kecamatanRepository,
        VillagesRepository $desaRepository,
        StudyProgramRepository $studyProgramRepository,
        InstitutionRepository $instituteRepository,
        DepartmentRepository $departmentRepository,
        EducationRepository $educationRepository,
        BankAccountRepository $bankAccountRepository
    ) {
        $this->middleware('auth');
        $this->modul = "biodata";
        $this->addressRepo = $addressRepository;
        $this->qualificationRepository = $qualificationRepository;
        $this->certificationRepo = $certificationRepository;
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->provinceRepo = $provinceRepository;
        $this->kabupatenRepo = $kabupatenRepository;
        $this->kecamatanRepo = $kecamatanRepository;
        $this->desaRepo = $desaRepository;
        $this->programStudyRepo = $studyProgramRepository;
        $this->institutionRepo = $instituteRepository;
        $this->educationRepo = $educationRepository;
        $this->departmentRepo = $departmentRepository;
        $this->bankAccount = $bankAccountRepository;
        $this->gtt = $gttRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $biodata = $this->repository->findByField('user_id', Auth::user()->id)->first();
        if (Auth::user()->role_id == 2){
            return redirect('apps/biodata/' . $biodata->id . '/edit');
        }else{
            return back();
        }
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
        $modul = 'biodata';
        $cp = $this->repository->find($id);
        $qualifikasi = $this->qualificationRepository->all();
        $gttFind = $this->gtt->findByField('user_id', $cp->user_id)->first();
        if ($gttFind != null) {
            return view('biodatas.index', compact('cp', 'modul', 'qualifikasi', 'gttFind'));
        } else {
            return view('biodatas.edit', compact('cp', 'modul', 'qualifikasi', 'gttFind'));
        }
        // dd($cp->user->education);

    }

    public function show($id)
    {
        $modul = 'biodata';
        $cp = $this->repository->find($id);
        $qualifikasi = $this->qualificationRepository->all();
        $gttFind = $this->gtt->findByField('user_id', $cp->user_id)->first();
        return view('biodatas.show', compact('cp', 'modul','gttFind','qualifikasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BiodataUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BiodataUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $cekBio = $this->repository->find($id);
            if ($cekBio->nik != $request->nik){
                $cekNikExists = $this->repository->findByField('nik',$request->nik);
                // dd(count($cekNikExists));
                if (count($cekNikExists) > 0){
                    Alert::info('Informasi', 'NIK sudah terdaftar');
                    return back();
                }
            }
            $user = User::findOrFail($cekBio->user_id);
            if ($request->has('avatar')) {
                $upload = $request->file('avatar');
                $extensi = $upload->getClientOriginalExtension();
                $name = $user->id . '_' . rand(100, 9999) . '.' . $extensi;
                $upload->move(public_path() . '/uploads/', $name);
                $user->avatar = '/uploads/' . $name;
            }
            $user->update();
            $province = $this->provinceRepo->updateOrCreate(
                [
                    'name' => $request->provinsi
                ]
            );

            $kabupaten = $this->kabupatenRepo->updateOrCreate(
                [
                    'name' => $request->kabupaten,
                    'province_id' => $province->id
                ]
            );

            $kecamatan = $this->kecamatanRepo->updateOrCreate(
                [
                    'name' => $request->kecamatan,
                    'districts_id' => $kabupaten->id
                ]
            );

            $desa = $this->desaRepo->updateOrCreate(
                [
                    'name' => $request->desa,
                    'sub_districts_id' => $kecamatan->id
                ]
            );


            $addressFind = $this->addressRepo->findByField('user_id',$cekBio->user_id)->first();
            $address = [
                "name" => $request->alamat,
                "province_id" => $province->id,
                "districts_id" => $kabupaten->id,
                "sub_districts_id" => $kecamatan->id,
                "village_id" => $desa->id,
                "user_id" => $cekBio->user_id
            ];
            if ($addressFind) {
                $this->addressRepo->update($address, $addressFind->id);
            } else {
                $this->addressRepo->create($address);
            }

            $bankFind = $this->bankAccount->findByField('user_id', $cekBio->user_id)->first();
            $bank = [
                "bank_name" => $request->bank_name,
                "account_name" => $request->account_name,
                "account_number" => $request->account_number,
                "user_id" => $cekBio->user_id
            ];
            if ($bankFind) {
                $this->bankAccount->update($bank, $bankFind->id);
            } else {
                $this->bankAccount->create($bank);
            }

            $certiFind = $this->certificationRepo->findByField('user_id', $cekBio->user_id)->first();
            $certification = [
                "no_cert" => $request->no_cert,
                "no_part" => $request->no_part,
                "nrg" => $request->nrg,
                "year_cert" => $request->year_cert,
                "user_id" => $cekBio->user_id
            ];
            if ($certiFind) {
                $this->certificationRepo->update($certification, $certiFind->id);
            } else {
                $this->certificationRepo->create($certification);
            }

            $institution = $this->institutionRepo->updateOrCreate(
                ['name' => $request->institution]
            );

            $study_program = $this->programStudyRepo->updateOrCreate(
                [
                    'name' => $request->study_program,
                    'institution_id' => $institution->id
                ]
            );

            $department = $this->departmentRepo->updateOrCreate(
                [
                    'name' => $request->department,
                    'study_program_id' => $study_program->id
                ]
            );

            $eduFind = $this->educationRepo->findByField('user_id', $cekBio->user_id)->first();
            $education = [
                "year_edu" => $request->year_edu,
                "institution_id" => $institution->id,
                "study_program_id" => $study_program->id,
                "department_id" => $department->id,
                "qualification_id" => $request->qualification,
                "user_id" => $cekBio->user_id
            ];
            if ($eduFind) {
                $this->educationRepo->update($education, $eduFind->id);
            } else {
                $this->educationRepo->create($education);
            }

            $biodatum = $this->repository->update($request->all(), $id);
            // return view('biodatas.edit', compact('gtt', 'modul', 'qualifikasi'));
            $response = [
                'message' => 'Biodata updated.',
                'data'    => $biodatum->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            if (Auth::user()->role_id == 2){
                return redirect('apps/informasi');
            }else{
                Alert::success('Berhasil', 'Perubahan berhasil');
                return back();
            }
            // return view('biodatas.edit', compact('cp', 'modul', 'qualifikasi'));

        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            Alert::error('Gagal', 'Terjadi Kesalahan '.$e->getMessage());
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }
}
