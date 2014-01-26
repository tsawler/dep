<?php

use Illuminate\Database\Migrations\Migration;

class CreateMakeAuthorsTable extends Migration {

	public function up() {
    	Schema::create('authors', function($table) {
	        $table->increments('id');
	        $table->integer('user_id')->index();
	        $table->string('pen_name');
	        $table->integer('active');
	        $table->string('phone');
	        $table->string('address');
	        $table->string('city');
	        $table->integer('province_id');
	        $table->integer('country_id');
	        $table->integer('zip');
	        $table->timestamps();
		});
	}

	public function down() {
    	Schema::drop('authors');
	}

}