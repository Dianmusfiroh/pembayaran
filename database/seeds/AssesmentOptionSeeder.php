<?php

use App\Entities\AssesmentOption;
use Illuminate\Database\Seeder;

class AssesmentOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AssesmentOption::updateOrCreate([
            'name' => 'Sertifikasi'
        ]);
        AssesmentOption::updateOrCreate([
            'name' => 'Ijazah Terakhir ( Sarjana )'
        ]);
        AssesmentOption::updateOrCreate([
            'name' => 'SK Bupati'
        ]);
        AssesmentOption::updateOrCreate([
            'name' => 'KTP'
        ]);
        AssesmentOption::updateOrCreate([
            'name' => 'Diklat'
        ]);
        AssesmentOption::updateOrCreate([
            'name' => 'Ijazah Komputer'
        ]);
        AssesmentOption::updateOrCreate([
            'name' => 'Ijazah SLTA'
        ]);
    }
}
