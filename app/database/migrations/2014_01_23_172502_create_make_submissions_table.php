<?php

use Illuminate\Database\Migrations\Migration;

class CreateMakeSubmissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('submissions', function($table) {
	        $table->increments('id');
	        $table->integer('user_id')->index();
	        $table->string('pen_name');
	        $table->string('phone');
	        $table->binary('manuscript');
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
		Schema::drop('submissions');
	}

}