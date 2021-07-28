<?php

use App\Entities\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::updateOrCreate([
            'name' => 'Sementara',
            'description' => 'SPM Sementara',
            'status_for' => 'INVOICE',
            'author_id' => 1
        ]);
        Status::updateOrCreate([
            'name' => 'Proses',
            'description' => 'Proses Penagihan',
            'status_for' => 'INVOICE',
            'author_id' => 1
        ]);
        Status::updateOrCreate([
            'name' => 'SP2D',
            'description' => 'SP2D',
            'status_for' => 'INVOICE',
            'author_id' => 1
        ]);
        Status::updateOrCreate([
            'name' => 'Baru',
            'description' => 'Baru Mendaftar',
            'status_for' => 'FORMATION',
            'author_id' => 1
        ]);
        Status::updateOrCreate([
            'name' => 'LULUS TAHAP I',
            'description' => 'Lulus Berkas',
            'status_for' => 'FORMATION',
            'author_id' => 1
        ]);
        Status::updateOrCreate([
            'name' => 'TIDAK LULUS TAHAP I',
            'description' => 'Tidak Lulus Berkas',
            'status_for' => 'FORMATION',
            'author_id' => 1
        ]);
        Status::updateOrCreate([
            'name' => 'LULUS TAHAP II',
            'description' => 'Lulus Testing / Uji Kompotensi',
            'status_for' => 'FORMATION',
            'author_id' => 1
        ]);
        Status::updateOrCreate([
            'name' => 'TIDAK LULUS TAHAP II',
            'description' => 'Tidak Lulus Testing / Uji Kompotensi',
            'status_for' => 'FORMATION',
            'author_id' => 1
        ]);
    }
}
