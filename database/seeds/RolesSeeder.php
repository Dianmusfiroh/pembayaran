<?php

use App\Entities\Role;
use App\Entities\Roles;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrCreate([
            'name' => 'Administrator'
        ]);
        Role::updateOrCreate([
            'name' => 'Operatordinas'
        ]);
        Role::updateOrCreate([
            'name' => 'Pimpinan'
        ]);
        Role::updateOrCreate([
            'name' => 'Operatorsekolah'
        ]);
        Role::updateOrCreate([
            'name' => 'Pembayaran'
        ]);
    }
}
