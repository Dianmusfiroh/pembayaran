<?php

use App\Entities\Jabatan;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jabatan::updateOrCreate([
            'name' => 'Guru Kelas',
            'position_category_id' => 1,
            'author_id' => 1
        ]);
        Jabatan::updateOrCreate([
            'name' => 'Guru Agama',
            'position_category_id' => 1,
            'author_id' => 1
        ]);
        Jabatan::updateOrCreate([
            'name' => 'Guru PJOK',
            'position_category_id' => 1,
            'author_id' => 1
        ]);
        Jabatan::updateOrCreate([
            'name' => 'Guru PKN',
            'position_category_id' => 1,
            'author_id' => 1
        ]);
        Jabatan::updateOrCreate([
            'name' => 'Guru Bahasa Indonesia',
            'position_category_id' => 1,
            'author_id' => 1
        ]);
        Jabatan::updateOrCreate([
            'name' => 'Guru Bahasa Inggris',
            'position_category_id' => 1,
            'author_id' => 1
        ]);
        Jabatan::updateOrCreate([
            'name' => 'Guru Matematika',
            'position_category_id' => 1,
            'author_id' => 1
        ]);
        Jabatan::updateOrCreate([
            'name' => 'Guru IPA',
            'position_category_id' => 1,
            'author_id' => 1
        ]);
        Jabatan::updateOrCreate([
            'name' => 'Guru IPS',
            'position_category_id' => 1,
            'author_id' => 1
        ]);
        Jabatan::updateOrCreate([
            'name' => 'Guru Seni Budaya',
            'position_category_id' => 1,
            'author_id' => 1
        ]);
        Jabatan::updateOrCreate([
            'name' => 'Guru Keterampilan/TIK',
            'position_category_id' => 1,
            'author_id' => 1
        ]);
        Jabatan::updateOrCreate([
            'name' => 'Guru Mulok',
            'position_category_id' => 1,
            'author_id' => 1
        ]);
        Jabatan::updateOrCreate([
            'name' => 'Guru BK',
            'position_category_id' => 1,
            'author_id' => 1
        ]);
        Jabatan::updateOrCreate([
            'name' => 'Operator',
            'position_category_id' => 2,
            'author_id' => 1
        ]);
        Jabatan::updateOrCreate([
            'name' => 'Pustakawan',
            'position_category_id' => 2,
            'author_id' => 1
        ]);
        Jabatan::updateOrCreate([
            'name' => 'Laboran',
            'position_category_id' => 2,
            'author_id' => 1
        ]);
    }
}
