<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'name' => 'Administrator', 
            'email' => 'admin@sipenas.com', 
            'password' => '$2y$12$jPw1Y.c9DPiftsJYM88S5uxUzCXWfhHxTI.Ffee2hV4wxGAgd.IsO',
            'role_id' => 1
        ]);
    }
}
