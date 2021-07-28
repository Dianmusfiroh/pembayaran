<?php

use App\Entities\Sumber;
use Illuminate\Database\Seeder;

class SumberAnggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sumber::updateOrCreate([
            'nama' => 'APBD Induk'
        ]);
        Sumber::updateOrCreate([
            'nama' => 'APBD Perubahan'
        ]);
    }
}
