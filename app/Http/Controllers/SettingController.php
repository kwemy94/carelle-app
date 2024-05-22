<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $settingRepository;

    public function __construct(SettingRepository $settingRepository){
        $this->settingRepository = $settingRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = $this->settingRepository->getAll();

        return view('admin.setting.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $inputs = $request->except('_token','_method');
        try {
            foreach ($inputs as $key => $value) {
                $id = explode("_", $key);
                dd($key, $value);
                $this->settingRepository->update($id[1], ['status' => 1]);
            }
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with(['success' => false, "message" => "une erreur : " . $th->getMessage()]);
        }

        return redirect()->back()->with(['success' => true, "message" => "Configurations enregistrées !"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
