<?php

use App\Entities\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::updateOrCreate([
            'label' => 'nip_kadis',
            'nilai' => '123456'
        ]);
        Settings::updateOrCreate([
            'label' => 'nama_kadis',
            'nilai' => 'coba'
        ]);
        Settings::updateOrCreate([
            'label' => 'nip_bendahara_pengeluaran',
            'nilai' => '19791004 200701 2 009'
        ]);
        Settings::updateOrCreate([
            'label' => 'nama_bendahara_pengeluaran',
            'nilai' => 'SUHARTININGSIH KATILI, S.Ap'
        ]);
        Settings::updateOrCreate([
            'label' => 'nip_bendara1',
            'nilai' => '1223'
        ]);
        Settings::updateOrCreate([
            'label' => 'nama_bendahara1',
            'nilai' => 'bendahara 1 dumy'
        ]);
        Settings::updateOrCreate([
            'label' => 'kpa_name',
            'nilai' => 'IRMAWATY ACHMAD, S.Pd, MM'
        ]);
        Settings::updateOrCreate([
            'label' => 'kpa_eselon',
            'nilai' => 'Pembina Tkt. I/lvb'
        ]);
        Settings::updateOrCreate([
            'label' => 'kpa_nip',
            'nilai' => '19670626 198504 2 001'
        ]);
    }
}
