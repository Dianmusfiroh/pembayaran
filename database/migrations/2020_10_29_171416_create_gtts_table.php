<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateGttsTable.
 */
class CreateGttsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gtt', function(Blueprint $table) {
			$table->string('id')->primary();
			$table->string('nik', 16)->nullable();
			$table->string('nuptk', 16)->nullable();
			$table->string('full_name')->nullable();
			$table->string('title_ahead', 100)->nullable();
			$table->string('back_title', 100)->nullable();
			$table->date('date_of_birth')->nullable();
			$table->string('place_of_birth', 100)->nullable();
			$table->date('tmt_start')->nullable();
			$table->date('tmt_end')->nullable();
			$table->string('user_id')->nullable();
			$table->string('bank_name')->nullable();
			$table->string('account_name')->nullable();
			$table->string('account_number')->nullable();
			$table->unsignedInteger('bank_account_id');
			$table->unsignedInteger('institute_id');
			$table->unsignedInteger('qualification_id');
			$table->unsignedInteger('position_id');
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('gtt');
	}
}
