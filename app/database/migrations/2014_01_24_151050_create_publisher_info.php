<?php

use Illuminate\Database\Migrations\Migration;

class CreatePublisherInfo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('publisher_info', function($table) {
	        $table->increments('id');
	        $table->integer('user_id')->index();
	        $table->string('address');
	        $table->string('phone');
	        $table->string('province');
	        $table->string('province_other');
	        $table->string('country');
	        $table->string('zip');
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
		Schema::drop('publisher_info');
	}

}