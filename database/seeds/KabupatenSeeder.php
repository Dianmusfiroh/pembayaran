<?php

use App\Entities\Kabupaten;
use Illuminate\Database\Seeder;

class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kabupaten::updateOrCreate([
            'name' => 'Gorontalo Utara',
            'province_id' => 1
        ]);
    }
}
