<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStriptagsFunction extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::raw('(DELIMITER $$ CREATE FUNCTION `strip_tags`($str text) RETURNS text '
			. 'BEGIN '
			. 'DECLARE $start, $end INT DEFAULT 1; '
			. 'LOOP '
			. 'SET $start = LOCATE("<", $str, $start); '
			. 'IF (!$start) THEN RETURN $str; END IF; '
			. 'SET $end = LOCATE(">", $str, $start); '
			. 'IF (!$end) THEN SET $end = $start; END IF; '
			. 'SET $str = INSERT($str, $start, $end - $start + 1, " "); '
			. 'END LOOP; '
			. 'END$$ DELIMITER;');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::raw("DROP FUNCTION `strip_tags`");
	}

}
