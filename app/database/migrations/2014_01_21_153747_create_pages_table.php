<?php

use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function($table) {
	        $table->increments('id');
	        $table->string('page_name')->unique();
	        $table->string('page_title');
	        $table->text('page_content');
	        $table->timestamps();
	        $table->integer('active');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pages');
	}

}