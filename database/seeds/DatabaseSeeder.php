<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call([
            RolesSeeder::class,
            UserSeeder::class,
            ProvinceSeeder::class,
            KabupatenSeeder::class,
            KecamatanSeeder::class,
            PositionCategorySeeder::class,
            JabatanSeeder::class,
            KlasterSeeder::class,
            JenjangPendidikanSeeder::class,
            SumberAnggaranSeeder::class,
            StatusSeeder::class,
            KualifikasiSeeder::class,
            AssesmentOptionSeeder::class,
            AssesmentScoreSeeder::class,
            SettingsSeeder::class,
            FormationCategorySeeder::class
        ]);
    }
}
