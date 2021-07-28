<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateProfileTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'candidate_profile';

    /**
     * Run the migrations.
     * @table candidate_profile
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('nik', 16)->nullable();
            $table->string('nuptk', 16)->nullable();
            $table->string('full_name')->nullable();
            $table->string('title_ahead', 100)->nullable();
            $table->string('back_title', 100)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth', 100)->nullable();
            $table->date('tmt_start')->nullable();
            $table->date('tmt_end')->nullable();
            $table->string('user_id')->nullable();

            $table->unique(["nik"], 'nik_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
