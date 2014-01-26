<?php

use Illuminate\Database\Migrations\Migration;

class CreateUserBooks extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_books', function($table) {
	        $table->increments('id');
	        $table->integer('user_id')->index();
	        $table->integer('book_id')->index();
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
		Schema::drop('user_books');
	}

}