<?php

use App\Entities\Klaster;
use Illuminate\Database\Seeder;

class KlasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Klaster::updateOrCreate([
            'name' => 'KLASTER 1'
        ]);
        Klaster::updateOrCreate([
            'name' => 'KLASTER 2'
        ]);
        Klaster::updateOrCreate([
            'name' => 'KLASTER 2'
        ]);
    }
}
