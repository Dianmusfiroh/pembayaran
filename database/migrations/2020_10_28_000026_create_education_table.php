<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'education';

    /**
     * Run the migrations.
     * @table education
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('year_edu')->nullable();
            $table->unsignedInteger('institution_id');
            $table->unsignedInteger('study_program_id');
            $table->unsignedInteger('department_id');
            $table->unsignedInteger('qualification_id');
            $table->string('user_id')->nullable();

            $table->index(["study_program_id"], 'fk_education_study_program1_idx');

            $table->index(["institution_id"], 'fk_education_institution1_idx');

            $table->index(["department_id"], 'fk_education_department1_idx');

            $table->index(["qualification_id"], 'fk_education_qualification1_idx');


            $table->foreign('study_program_id', 'fk_education_study_program1_idx')
                ->references('id')->on('study_program')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('department_id', 'fk_education_department1_idx')
                ->references('id')->on('department')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('institution_id', 'fk_education_institution1_idx')
                ->references('id')->on('institution')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('qualification_id', 'fk_education_qualification1_idx')
                ->references('id')->on('qualification')
                ->onDelete('restrict')
                ->onUpdate('cascade');
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
