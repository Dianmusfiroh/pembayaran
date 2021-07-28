<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssessmentScoreTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'assessment_score';

    /**
     * Run the migrations.
     * @table assessment_score
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('score')->nullable();
            $table->string('description', 45)->nullable();
            $table->unsignedInteger('assessment_option_id');
            $table->string('author_id')->nullable();

            $table->index(["assessment_option_id"], 'fk_assessment_score_assessment_option1_idx');


            $table->foreign('assessment_option_id', 'fk_assessment_score_assessment_option1_idx')
                ->references('id')->on('assessment_option')
                ->onDelete('cascade')
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
