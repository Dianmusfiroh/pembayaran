<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormationTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'formation';

    /**
     * Run the migrations.
     * @table formation
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('formation_needs_id');
            $table->string('candidate_id')->nullable();
            $table->boolean('formation_status')->nullable();
            $table->string('author_id')->nullable();

            $table->index(["formation_needs_id"], 'fk_formation_candidate_formation_needs1_idx');


            $table->foreign('formation_needs_id', 'fk_formation_candidate_formation_needs1_idx')
                ->references('id')->on('formation_needs')
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
