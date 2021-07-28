<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaguTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'pagu';

    /**
     * Run the migrations.
     * @table pagu
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('year')->nullable();
            $table->integer('jumlah')->nullable();
            $table->unsignedInteger('sumber_id');

            $table->index(["sumber_id"], 'fk_pagu_sumber1_idx');


            $table->foreign('sumber_id', 'fk_pagu_sumber1_idx')
                ->references('id')->on('sumber')
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
