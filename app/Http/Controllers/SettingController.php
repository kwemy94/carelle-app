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
        // dd($inputs);
        try {
            foreach ($inputs as $key => $value) {
                $id = explode("_", $key);
                // dd($key, $value);
                $this->settingRepository->update($id[1], ['status' => $value]);
            }
        } catch (\Throwable $th) {
            errorManager("error update setting : ", $th, $th);
            $notification = array(
                'message' => "une erreur s'est produite " . $th->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => "Configuration enregistrée avec succès !",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
