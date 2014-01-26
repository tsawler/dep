<?php

use Illuminate\Database\Migrations\Migration;


class RenameNameToFirstNameUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//DB::query("ALTER TABLE users CHANGE COLUMN `name` `first_name` varchar(255)';");
		DB::select(DB::raw("ALTER TABLE users CHANGE COLUMN `name` `first_name` varchar(255)"));
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