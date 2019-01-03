<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateMeetingTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('meeting', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('creatorId');
			$table->string('title');
			$table->string('place')->nullable();
			$table->enum('state', ['SUSPEND', 'ON', 'CANCEL','FINISHED']); //default is first item
			$table->timestamp('date');
			$table->timestamps();
			$table->softDeletes();
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('meeting');
	}
}
