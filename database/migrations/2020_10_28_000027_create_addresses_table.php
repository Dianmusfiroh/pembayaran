<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'addresses';

    /**
     * Run the migrations.
     * @table addresses
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->nullable();
            $table->unsignedInteger('province_id');
            $table->unsignedInteger('districts_id');
            $table->unsignedInteger('sub_districts_id');
            $table->unsignedInteger('village_id');
            $table->string('user_id')->nullable();

            $table->index(["sub_districts_id"], 'fk_addresses_sub_districts1_idx');

            $table->index(["districts_id"], 'fk_addresses_districts1_idx');

            $table->index(["province_id"], 'fk_addresses_province1_idx');

            $table->index(["village_id"], 'fk_addresses_villages1_idx');


            $table->foreign('province_id', 'fk_addresses_province1_idx')
                ->references('id')->on('province')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('districts_id', 'fk_addresses_districts1_idx')
                ->references('id')->on('districts')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('sub_districts_id', 'fk_addresses_sub_districts1_idx')
                ->references('id')->on('sub_districts')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('village_id', 'fk_addresses_villages1_idx')
                ->references('id')->on('villages')
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
