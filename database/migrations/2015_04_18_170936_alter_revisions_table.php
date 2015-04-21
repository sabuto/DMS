<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRevisionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		/*Schema::table('records', function(Blueprint $table)
		{
			$table->integer('creator', 10)->unsigned()->change();
			$table->renameColumn('creator', 'user_id');
			$table->foreign('user_id')->references('id')->on('users');
		});*/

		Schema::table('revisions', function(Blueprint $table)
		{
			$table->renameColumn('recordID', 'record_id');
			$table->foreign('record_id')->references('id')->on('records');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('records', function(Blueprint $table)
		{
			$table->String('user_id')->change();
			$table->renameColumn('user_id', 'creator');

		});

		Schema::table('revisions', function(Blueprint $table)
		{
			$table->string('record_id'. 255)->change();
			$table->renameColumn('record_id', 'recordID');
		});
	}

}
