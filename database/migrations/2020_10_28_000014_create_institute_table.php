<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstituteTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'institute';

    /**
     * Run the migrations.
     * @table institute
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('npsn', 10)->nullable();
            $table->string('name')->nullable();
            $table->text('address')->nullable();
            $table->unsignedInteger('educational_stage_id');
            $table->integer('province_id');
            $table->integer('districts_id');
            $table->integer('sub_districts_id');
            $table->unsignedInteger('cluster_id');
            $table->string('author_id')->nullable();

            $table->index(["educational_stage_id"], 'fk_institute_educational_stage1_idx');

            $table->index(["cluster_id"], 'fk_institute_cluster1_idx');


            $table->foreign('educational_stage_id', 'fk_institute_educational_stage1_idx')
                ->references('id')->on('educational_stage')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('cluster_id', 'fk_institute_cluster1_idx')
                ->references('id')->on('cluster')
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
