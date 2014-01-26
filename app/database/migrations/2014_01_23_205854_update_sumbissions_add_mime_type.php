<?php

use Illuminate\Database\Migrations\Migration;

class UpdateSumbissionsAddMimeType extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('submissions', function($table)
		{
		    $table->string('mime_type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}