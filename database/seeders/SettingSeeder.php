<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = array(
            array(
                'name' => "Activer l'enregistrement des utilisateurs",
                'status' => 0
            )
        );

        foreach ($settings as $setting) {
            $exitSetting = Setting::where('name', $setting['name'])->first();

            if (!$exitSetting) {
                Setting::create($setting);
            }
        }
    }
}
