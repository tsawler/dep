<?php

use Illuminate\Database\Migrations\Migration;

class AddCityToPublisherInfo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('publisher_info', function($table)
		{
		    $table->string('city');
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