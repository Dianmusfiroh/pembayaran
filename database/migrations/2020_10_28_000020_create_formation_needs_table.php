<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormationNeedsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'formation_needs';

    /**
     * Run the migrations.
     * @table formation_needs
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id')->primary();
            $table->integer('quantity')->nullable();
            $table->integer('formation_year')->nullable();
            $table->unsignedInteger('institute_id');
            $table->unsignedInteger('qualification_id');
            $table->unsignedInteger('position_id');
            $table->string('author_id')->nullable();

            $table->index(["institute_id"], 'fk_formation_needs_institute1_idx');

            $table->index(["position_id"], 'fk_formation_needs_position1_idx');

            $table->index(["qualification_id"], 'fk_formation_needs_qualification_idx');


            $table->foreign('institute_id', 'fk_formation_needs_institute1_idx')
                ->references('id')->on('institute')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('qualification_id', 'fk_formation_needs_qualification_idx')
                ->references('id')->on('qualification')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('position_id', 'fk_formation_needs_position1_idx')
                ->references('id')->on('position')
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
