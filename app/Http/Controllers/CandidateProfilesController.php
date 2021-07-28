<?php

namespace App\Http\Controllers;

use App\Entities\Address;
use App\Entities\CandidateProfile;
use App\Entities\Certification;
use App\Entities\Department;
use App\Entities\Education;
use App\Entities\Institution;
use App\Entities\Kabupaten;
use App\Entities\Kecamatan;
use App\Entities\Province;
use App\Entities\Qualification;
use App\Entities\StudyProgram;
use App\Entities\Villages;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\addressCreateRequest;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CandidateProfileCreateRequest;
use App\Http\Requests\CandidateProfileUpdateRequest;
use App\Repositories\AddressRepository;
use App\Repositories\CandidateProfileRepository;
use App\Repositories\CertificationRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\DesaRepository;
use App\Repositories\EducationRepository;
use App\Repositories\InstitutionRepository;
use App\Repositories\KabupatenRepository;
use App\Repositories\KecamatanRepository;
use App\Repositories\ProvinceRepository;
use App\Repositories\QualificationRepository;
use App\Repositories\StudyProgramRepository;
use App\Repositories\VillagesRepository;
use App\User;
use App\Validators\CandidateProfileValidator;
use Illuminate\Support\Facades\DB;
use mysqli;

/**
 * Class CandidateProfilesController.
 *
 * @package namespace App\Http\Controllers;
 */
class CandidateProfilesController extends Controller
{
    /**
     * @var CandidateProfileRepository
     */
    protected $repository;
    protected $addressRepo;
    protected $userRepo;
    protected $qualifikasirepo;
    protected $certificationRepo;
    protected $provinceRepo;
    protected $kabupatenRepo;
    protected $kecamatanRepo;
    protected $desaRepo;
    protected $institutionRepo;
    protected $programStudyRepo;
    protected $departmentRepo;
    protected $educationRepo;

    /**
     * @var CandidateProfileValidator
     */
    protected $validator;

    /**
     * CandidateProfilesController constructor.
     *
     * @param CandidateProfileRepository $repository
     * @param CandidateProfileValidator $validator
     */
    public function __construct(
        CandidateProfileRepository $repository,
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
        CandidateProfileValidator $validator
    ) {
        $this->middleware('auth');
        $this->addressRepo = $addressRepository;
        $this->qualifikasirepo = $qualificationRepository;
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
        $this->modul = 'peserta';
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
        $candidateProfiles = $this->repository->all();


        if (request()->wantsJson()) {

            return response()->json([
                'data' => $candidateProfiles,
            ]);
        }

        return view('pendaftaran.index', compact('candidateProfiles', 'modul'));
    }



    public function create()
    {
        $modul = $this->modul;
        // $candidate = CandidateProfile::all(); --> unused resource

        // return view('pendaftaran.create', compact('modul', 'candidate'));

        $qualifikasi = $this->qualifikasirepo->all();
        return view('pendaftaran.create', compact('modul', 'qualifikasi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CandidateProfileCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CandidateProfileCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            // dd($request);
            $user = new User();
            $user->name = $request->full_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            // cek nama propinsi
            $province = $this->provinceRepo->updateOrCreate(
                ['name' => $request->provinsi]
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

            $this->addressRepo->updateOrCreate(
                [
                    'name' => $request->alamat,
                    'province_id' => $province->id,
                    'districts_id' => $kabupaten->id,
                    'sub_districts_id' => $kecamatan->id,
                    'village_id' => $desa->id,
                    'user_id' => $user->id
                ]
            );

            $this->certificationRepo->updateOrCreate(
                [
                    'no_cert' => $request->no_cert,
                    'no_part' => $request->no_part,
                    'nrg' => $request->nrg,
                    'year_cert' => $request->year_cert,
                    'user_id' => $user->id
                ]
            );
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

            $this->educationRepo->updateOrCreate(
                [
                    'year_edu' => $request->year_edu,
                    'department_id' => $department->id,
                    'qualification_id' => $request->qualification,
                    'study_program_id' => $study_program->id,
                    'institution_id' => $institution->id,
                    'user_id' => $user->id
                ]
            );

            $input_candidate = $request->all();
            $input_candidate['user_id'] = $user->id;
            $candidateProfile = $this->repository->create($input_candidate);

            $response = [
                'message' => 'CandidateProfile created.',
                'data'    => $candidateProfile->toArray(),
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
        $candidateProfile = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $candidateProfile,
            ]);
        }

        return view('candidateProfiles.show', compact('candidateProfile'));
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
        $cp = $this->repository->find($id);
        $user_id = $cp->user_id;

        // $address = DB::table('addresses')->where('user_id', $user_id)->first();
        $address = $this->addressRepo->findByField('user_id', $user_id)->first();
        // dd($address->id);
        $village = $this->desaRepo->findByField(
            'id',
            $address->village_id
        )->first();
        $sub_district = $this->kecamatanRepo->findByField(
            'id',
            $address->sub_districts_id
        )->first();
        $district = $this->kabupatenRepo->findByField(
            'id',
            $address->districts_id
        )->first();
        $province = $this->provinceRepo->findByField(
            'id',
            $address->province_id
        )->first();
        $certification = $this->certificationRepo->findByField(
            'user_id',
            $user_id
        )->first();
        $education = $this->educationRepo->findByField(
            'user_id',
            $user_id
        )->first();
        $institution = $this->institutionRepo->findByField(
            'id',
            $education->institution_id
        )->first();
        $study_program = $this->programStudyRepo->findByField(
            'id',
            $education->study_program_id
        )->first();
        $department = $this->departmentRepo->findByField(
            'id',
            $education->department_id
        )->first();

        $qualifikasi = Qualification::all();
        $modul = $this->modul;

        return view('pendaftaran.edit', compact('cp', 'modul', 'address', 'village', 'sub_district', 'district', 'province', 'certification', 'qualifikasi', 'education', 'institution', 'study_program', 'department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CandidateProfileUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CandidateProfileUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $cp = $this->repository->find($id);
            $user_id = $cp->user_id;

            $user = User::findOrFail($user_id);
            $user->name = $request->full_name;
            $user->update();


            $candidateProfile = $this->repository->update($request->all(), $id);
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


            $addressFind = $this->addressRepo->findByField('user_id', $user->id)->first();
            $address = [
                "name" => $request->alamat,
                "province_id" => $province->id,
                "districts_id" => $kabupaten->id,
                "sub_districts_id" => $kecamatan->id,
                "village_id" => $desa->id,
                "user_id" => $user->id
            ];
            $this->addressRepo->update($address, $addressFind->id);

            $certiFind = $this->certificationRepo->findByField('user_id', $user->id)->first();
            // dd();
            $certification = [
                "no_cert" => $request->no_cert,
                "no_part" => $request->no_part,
                "nrg" => $request->nrg,
                "year_cert" => $request->year_cert,
                "user_id" => $user->id
            ];
            $this->certificationRepo->update($certification, $certiFind->id);

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

            $eduFind = $this->educationRepo->findByField('user_id', $user_id)->first();
            $education = [
                "year_edu" => $request->year_edu,
                "institution_id" => $institution->id,
                "study_program_id" => $study_program->id,
                "department_id" => $department->id,
                "user_id" => $user->id
            ];
            $this->educationRepo->update($education, $eduFind->id);

            $response = [
                'message' => 'CandidateProfile updated.',
                'data'    => $candidateProfile->toArray(),
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
                'message' => 'CandidateProfile deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'CandidateProfile deleted.');
    }
}
