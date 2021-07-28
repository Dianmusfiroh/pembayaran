<?php

use App\Entities\PositionCategory;
use Illuminate\Database\Seeder;

class PositionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PositionCategory::updateOrCreate([
            'name' => 'GURU'
        ]);
        PositionCategory::updateOrCreate([
            'name' => 'TENDIK'
        ]);
    }
}
