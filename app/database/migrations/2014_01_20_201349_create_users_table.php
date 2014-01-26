<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	public function up() {
    	Schema::create('users', function($table) {
	        $table->increments('id');
	        $table->string('email')->unique();
	        $table->string('name');
	        $table->timestamps();
	        $table->string('password');
	        $table->integer('access_level');
		});
	}

	public function down() {
    	Schema::drop('users');
	}

}