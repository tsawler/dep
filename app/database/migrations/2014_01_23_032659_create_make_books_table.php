<?php

use Illuminate\Database\Migrations\Migration;

class CreateMakeBooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
    	Schema::create('books', function($table) {
	        $table->increments('id');
	        $table->string('book_title')->unique();
	        $table->integer('author_id')->index();
	        $table->date('publication_date');
	        $table->integer('active');
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
		Schema::drop('books');
	}

}