<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkDetailTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'sk_detail';

    /**
     * Run the migrations.
     * @table sk_detail
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('gtt_id')->nullable();
            $table->unsignedInteger('sk_id');

            $table->index(["sk_id"], 'fk_sk_detail_sk1_idx');


            $table->foreign('sk_id', 'fk_sk_detail_sk1_idx')
                ->references('id')->on('sk')
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
