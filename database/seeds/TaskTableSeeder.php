<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TaskTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('task')->insert([

			'userId' => '3',
			'type'   => 'PERSONAL',
			'title' => 'کلاس دانشگاه',
			'date' => '2019-01-5 09:00:00'

		]);
	}
}
