<?php

use App\Entities\FormationCategory;
use Illuminate\Database\Seeder;

class FormationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FormationCategory::updateOrCreate([
            'name' => 'Formasi APBD',
            'slug' => 'apbd'
        ]);
        FormationCategory::updateOrCreate([
            'name' => 'Formasi DANA BOS',
            'slug' => 'dana-bos'
        ]);
        FormationCategory::updateOrCreate([
            'name' => 'Formasi APBDDesa',
            'slug' => 'apbd-desa'
        ]);
    }
}
