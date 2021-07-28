<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAssessmentDetailsTable.
 */
class CreateAssessmentDetailsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assessment_details', function(Blueprint $table) {
			$table->string('id')->primary();
			$table->unsignedInteger('assesment_id');
			$table->unsignedInteger('assessment_option_id');
			$table->unsignedInteger('assessment_score_id');
			$table->integer('score');
			$table->string('description')->nullable();
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
		Schema::drop('assessment_details');
	}
}
