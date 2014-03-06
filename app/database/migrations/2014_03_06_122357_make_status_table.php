<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeStatusTable extends Migration {

	public function up()
	{
		{
		Schema::create('statuses', function($table) {
	        $table->increments('id');
	        $table->string('status_name');
	        $table->timestamps();
		});
	}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('statuses');
	}

}
