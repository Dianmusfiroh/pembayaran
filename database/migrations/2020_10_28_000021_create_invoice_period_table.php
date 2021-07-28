<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicePeriodTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'invoice_period';

    /**
     * Run the migrations.
     * @table invoice_period
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('period')->nullable();
            $table->string('invoice_id');

            $table->index(["invoice_id"], 'fk_invoice_period_invoice1_idx');


            $table->foreign('invoice_id', 'fk_invoice_period_invoice1_idx')
                ->references('id')->on('invoice')
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
