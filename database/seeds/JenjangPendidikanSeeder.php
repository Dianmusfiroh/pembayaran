<?php

use App\Entities\JenjangPendidikan;
use Illuminate\Database\Seeder;

class JenjangPendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenjangPendidikan::updateOrCreate([
            'name' => 'PAUD',
            'description' => 'PENDIDIKAN ANAK USIA DINI',
            'author_id' => 1
        ]);
        JenjangPendidikan::updateOrCreate([
            'name' => 'TK',
            'description' => 'TAMAN KANAK-KANAK',
            'author_id' => 1
        ]);
        JenjangPendidikan::updateOrCreate([
            'name' => 'SD',
            'description' => 'SEKOLAH DASAR',
            'author_id' => 1
        ]);
        JenjangPendidikan::updateOrCreate([
            'name' => 'SMP',
            'description' => 'SEKOLAH MENENGAH PERTAMA',
            'author_id' => 1
        ]);
        JenjangPendidikan::updateOrCreate([
            'name' => 'RA',
            'description' => 'RA',
            'author_id' => 1
        ]);
        JenjangPendidikan::updateOrCreate([
            'name' => 'MI',
            'description' => 'MI',
            'author_id' => 1
        ]);
        JenjangPendidikan::updateOrCreate([
            'name' => 'MTS',
            'description' => 'MTS',
            'author_id' => 1
        ]);
    }
}
