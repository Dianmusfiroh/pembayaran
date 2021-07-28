<?php

use App\Entities\Kecamatan;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kecamatan::updateOrCreate([
            'name' => 'Anggrek',
            'districts_id' => 1
        ]);
        Kecamatan::updateOrCreate([
            'name' => 'Atinggola',
            'districts_id' => 1
        ]);
        Kecamatan::updateOrCreate([
            'name' => 'Kwandang',
            'districts_id' => 1
        ]);
        Kecamatan::updateOrCreate([
            'name' => 'Sumalata',
            'districts_id' => 1
        ]);
        Kecamatan::updateOrCreate([
            'name' => 'Tolinggula',
            'districts_id' => 1
        ]);
        Kecamatan::updateOrCreate([
            'name' => 'Gentuma Raya',
            'districts_id' => 1
        ]);
        Kecamatan::updateOrCreate([
            'name' => 'Tomilito',
            'districts_id' => 1
        ]);
        Kecamatan::updateOrCreate([
            'name' => 'Ponelo Kepulauan',
            'districts_id' => 1
        ]);
        Kecamatan::updateOrCreate([
            'name' => 'Monano',
            'districts_id' => 1
        ]);
        Kecamatan::updateOrCreate([
            'name' => 'Biau',
            'districts_id' => 1
        ]);
        Kecamatan::updateOrCreate([
            'name' => 'Sumalata Timur',
            'districts_id' => 1
        ]);
    }
}
