<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SettingsCreateRequest;
use App\Http\Requests\SettingsUpdateRequest;
use App\Repositories\SettingsRepository;
use App\Validators\SettingsValidator;

/**
 * Class SettingsController.
 *
 * @package namespace App\Http\Controllers;
 */
class SettingsController extends Controller
{
    /**
     * @var SettingsRepository
     */
    protected $repository;

    /**
     * @var SettingsValidator
     */
    protected $validator;

    /**
     * SettingsController constructor.
     *
     * @param SettingsRepository $repository
     * @param SettingsValidator $validator
     */
    public function __construct(SettingsRepository $repository, SettingsValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;

        $this->modul = "umum";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $settings = $this->repository->all();
        $modul = $this->modul;

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $settings,
            ]);
        }

        return view('settings.index', compact('settings', 'modul'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SettingsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SettingsCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $req = $request->all();
            $nilai = $req['nilai'];

            // dd($req);
            // foreach ($req as $key => $item) {
            //     $id = $req['id'];
            //     dd($item);
            // $id = $this->repository->findWhere()
            $setting = $this->repository->update($req('nilai'), $req['id']);
            // $setting = $this->repository->updateOrCreate($id, $req['nilai']);
            // }

            $response = [
                'message' => 'Settings created.',
                'data'    => $setting->toArray(),
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
        $setting = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $setting,
            ]);
        }

        return view('settings.show', compact('setting'));
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
        $setting = $this->repository->find($id);
        $modul = $this->modul;

        return view('settings.edit', compact('setting', 'modul'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SettingsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SettingsUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $setting = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Settings updated.',
                'data'    => $setting->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }
            return redirect(url('pengaturan/umum'));

            // return redirect()->back()->with('message', $response['message']);
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
                'message' => 'Settings deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Settings deleted.');
    }
}
