<?php
use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateKinerjasTable.
 */
class CreateKinerjasTable extends Migration
{
    public $tableName = 'kinerja';
    /**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create($this->tableName, function (Blueprint $table) {

		// Schema::create('kinerja', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('presentase')->nullable();
            $table->integer('month');
            $table->integer('year')->nullable();
			$table->string('gtt_id');

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
       Schema::dropIfExists($this->tableName);

        // Schema::drop('kinerja');
    }
}
