<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'invoice';

    /**
     * Run the migrations.
     * @table invoice
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id')->primary();
            $table->string('no_spm');
            $table->string('no_sp2d')->nullable();
            $table->date('date_sp2d')->nullable();
            $table->date('invoice_date')->nullable();
            $table->string('author_id')->nullable();
            $table->unsignedInteger('status_id');

            $table->index(["status_id"], 'fk_invoice_status1_idx');
            $table->nullableTimestamps();


            $table->foreign('status_id', 'fk_invoice_status1_idx')
                ->references('id')->on('status')
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
