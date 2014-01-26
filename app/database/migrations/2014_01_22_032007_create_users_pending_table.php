<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersPendingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_pending', function($table)
    {
        $table->increments('id');
        $table->string('join_token');
        $table->string('email');
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
		Schema::drop('users_pending');
	}

}