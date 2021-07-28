<?php

use App\Entities\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::updateOrCreate([
            'name' => 'Gorontalo'
        ]);
    }
}
