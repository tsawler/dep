<?php

use Illuminate\Database\Migrations\Migration;

class AddStatusToSubmissions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('submissions', function($table)
		{
		    $table->integer('status');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}