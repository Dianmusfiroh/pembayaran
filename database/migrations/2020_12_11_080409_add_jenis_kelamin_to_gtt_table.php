<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJenisKelaminToGttTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gtt', function (Blueprint $table) {
            $table->boolean('jenis_kelamin');
        });
        Schema::table('candidate_profile',function(Blueprint $table){
            $table->boolean('jenis_kelamin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gtt', function (Blueprint $table) {
            $table->dropColumn('jenis_kelamin');
        });

        Schema::table('candidate_profile',function(Blueprint $table){
            $table->dropColumn('jenis_kelamin');
        });
    }
}
