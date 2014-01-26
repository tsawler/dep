<?php

use Illuminate\Database\Migrations\Migration;

class UpdatedBooks extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('books', function($table)
		{
		    $table->binary('epub');
		    $table->binary('mobi');
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