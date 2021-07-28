<?php

use App\Entities\Qualification;
use Illuminate\Database\Seeder;

class KualifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Qualification::updateOrCreate([
            'name' => 'S1',
            'incentive' => 900000,
            'description' => 'Sarjana',

        ]);
        Qualification::updateOrCreate([
            'name' => 'Non S1',
            'incentive' => 750000,
            'description' => 'Bukan Sarjana'
        ]);
    }
}
