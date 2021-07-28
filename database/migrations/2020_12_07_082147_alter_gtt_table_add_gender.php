<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterGttTableAddGender extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidate_profile',function(Blueprint $table){
            $table->boolean('gender')->nullable();
        });
        Schema::table('gtt', function (Blueprint $table) {
            $table->boolean('gender')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidate_profile', function (Blueprint $table) {
            $table->dropColumn('gender');
        });
        Schema::table('gtt', function (Blueprint $table) {
            $table->dropColumn('gender');
        });
    }
}
