<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudyProgramTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'study_program';

    /**
     * Run the migrations.
     * @table study_program
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->nullable();
            $table->unsignedInteger('institution_id');

            $table->index(["institution_id"], 'fk_study_program_institution1_idx');


            $table->foreign('institution_id', 'fk_study_program_institution1_idx')
                ->references('id')->on('institution')
                ->onDelete('no action')
                ->onUpdate('no action');
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
