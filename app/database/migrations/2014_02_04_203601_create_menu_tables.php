<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menus', function($table) {
	        $table->increments('id');
	        $table->string('menu_name')->unique();
	        $table->timestamps();
		});
		
		Schema::create('menu_items', function($table) {
	        $table->increments('id');
	        $table->integer('menu_id')->unsigned();
	        $table->string('menu_text');
	        $table->string('url');
			$table->integer('active');
			$table->integer('has_children')->unsigned();
	        $table->timestamps();
		});
		
		Schema::create('menu_dropdown_items', function($table) {
	        $table->increments('id');
	        $table->integer('menu_detail_id')->unsigned();
	        $table->string('menu_text');
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
		Schema::drop('menus');
		Schema::drop('menu_items');
		Schema::drop('menu_dropdown_items');
	}

}
