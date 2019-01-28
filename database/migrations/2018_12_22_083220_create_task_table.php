<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateTaskTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('task', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('userId');
			$table->integer('meetingId')->default(0);
			$table->enum('type', ['PERSONAL', 'MEETING']);
			$table->string('title')->nullable();
			$table->string('description')->nullable();
			$table->timestamp('date')->nullable();
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
		Schema::dropIfExists('task');
	}
}
