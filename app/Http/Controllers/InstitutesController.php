<?php

namespace App\Http\Controllers;

use App\Entities\Education;
use App\Entities\EducationalStage;
use App\Entities\Institute;
use App\Entities\Province;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InstituteCreateRequest;
use App\Http\Requests\InstituteUpdateRequest;
use App\Repositories\ClusterRepository;
use App\Repositories\EducationalStageRepository;
use App\Repositories\InstituteRepository;
use App\Repositories\KabupatenRepository;
use App\Repositories\KecamatanRepository;
use App\Repositories\ProvinceRepository;
use App\Validators\InstituteValidator;

/**
 * Class InstitutesController.
 *
 * @package namespace App\Http\Controllers;
 */
class InstitutesController extends Controller
{
    /**
     * @var InstituteRepository
     */
    protected $repository;
    protected $provinceRepo;
    protected $educationalRepo;
    protected $districtRepo;
    protected $subdistrictRepo;
    protected $clusterRepo;

    /**
     * @var InstituteValidator
     */
    protected $validator;

    /**
     * InstitutesController constructor.
     *
     * @param InstituteRepository $repository
     * @param InstituteValidator $validator
     */
    public function __construct(InstituteRepository $repository, InstituteValidator $validator, ProvinceRepository $provinceRepo, KabupatenRepository $districtRepo, KecamatanRepository $subdistrictRepo, EducationalStageRepository $educationalRepo, ClusterRepository $clusterRepo)
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->provinceRepo = $provinceRepo;
        $this->districtRepo = $districtRepo;
        $this->subdistrictRepo = $subdistrictRepo;
        $this->educationalRepo = $educationalRepo;
        $this->clusterRepo = $clusterRepo;
        $this->validator  = $validator;

        $this->modul = 'instansi';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $institutes = $this->repository->all();
        // $gabung = [$province, $district, $sub_district, $educational, $cluster, $institutes];
        $modul = $this->modul;
        if (request()->wantsJson()) {

            return response()->json([
                'data' => $institutes,
            ]);
        }
        // return $gabung;
        return view('instansi.index', compact('institutes', 'modul'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InstituteCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */

    public function create()
    {
        $modul = $this->modul;
        $province = $this->provinceRepo->all();
        $district = $this->districtRepo->all();
        $sub_district = $this->subdistrictRepo->all();
        $educational = $this->educationalRepo->all();
        $cluster = $this->clusterRepo->all();
        return view('instansi.create', compact('modul', 'province', 'district', 'sub_district', 'educational', 'cluster'));
    }

    public function store(InstituteCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $input = $request->all();
            $sub_district = $this->subdistrictRepo->find($request->sub_districts_id);
            $input['province_id'] = $sub_district->districts->province_id;
            $input['districts_id'] = $sub_district->districts->id;
            $institute = $this->repository->create($input);

            $response = [
                'message' => 'Institute created.',
                'data'    => $institute->toArray(),
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
        $institute = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $institute,
            ]);
        }

        return view('institutes.show', compact('institute'));
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
        $modul = $this->modul;
        $province = $this->provinceRepo->all();
        $district = $this->districtRepo->all();
        $sub_district = $this->subdistrictRepo->all();
        $educational = $this->educationalRepo->all();
        $cluster = $this->clusterRepo->all();
        $institute = $this->repository->find($id);
        // return $institute;
        return view('instansi.edit', compact('institute', 'modul', 'province', 'district', 'sub_district', 'educational', 'cluster'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InstituteUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(InstituteUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $institute = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Institute updated.',
                'data'    => $institute->toArray(),
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
                'message' => 'Institute deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Institute deleted.');
    }
}
