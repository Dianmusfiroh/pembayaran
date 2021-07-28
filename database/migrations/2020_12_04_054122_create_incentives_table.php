<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateIncentivesTable.
 */
class CreateIncentivesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('incentives', function(Blueprint $table) {
			$table->string('id')->primary();
			$table->integer('volume');
			$table->integer('kinerja');
			$table->string('invoice_detail_id');
            $table->nullableTimestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('incentives');
	}
}
