<?php

use App\Entities\AssesmentScore;
use Illuminate\Database\Seeder;

class AssesmentScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AssesmentScore::updateOrCreate([
            'score' => 50,
            'description' => 'Sertifikasi',
            'assessment_option_id' => 1
        ]);
        AssesmentScore::updateOrCreate([
            'score' => 20,
            'description' => 'Linier',
            'assessment_option_id' => 2
        ]);
        AssesmentScore::updateOrCreate([
            'score' => 15,
            'description' => 'Tidak Linier',
            'assessment_option_id' => 2
        ]);
        AssesmentScore::updateOrCreate([
            'score' => 1,
            'description' => 'Saat SLTA',
            'assessment_option_id' => 3
        ]);
        AssesmentScore::updateOrCreate([
            'score' => 2,
            'description' => 'Saat Sarjana',
            'assessment_option_id' => 3
        ]);
        AssesmentScore::updateOrCreate([
            'score' => 10,
            'description' => 'KTP Gorut  ( Rekomendasi Keahlian )',
            'assessment_option_id' => 4
        ]);
        AssesmentScore::updateOrCreate([
            'score' => 8,
            'description' => 'KTP Gorut tanpa Rekomendasi Keahlian',
            'assessment_option_id' => 4
        ]);
        AssesmentScore::updateOrCreate([
            'score' => 5,
            'description' => 'KTP luar Gorut ( Rekomendasi Keahlian )',
            'assessment_option_id' => 4
        ]);
        AssesmentScore::updateOrCreate([
            'score' => 1,
            'description' => 'KTP Luar Gorut tanpa Rekomendasi Keahlian',
            'assessment_option_id' => 4
        ]);
        AssesmentScore::updateOrCreate([
            'score' => 1,
            'description' => 'Diklat/Kursus/Seminar yang Linier',
            'assessment_option_id' => 5
        ]);
        AssesmentScore::updateOrCreate([
            'score' => 5,
            'description' => 'Ijazah Komputer',
            'assessment_option_id' => 6
        ]);
        AssesmentScore::updateOrCreate([
            'score' => 20,
            'description' => 'IPA',
            'assessment_option_id' => 7
        ]);
        AssesmentScore::updateOrCreate([
            'score' => 20,
            'description' => 'IPS',
            'assessment_option_id' => 7
        ]);
        AssesmentScore::updateOrCreate([
            'score' => 20,
            'description' => 'Bahasa',
            'assessment_option_id' => 7
        ]);
    }
}
