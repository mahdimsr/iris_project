<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AgendaTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('agenda')->insert([

			'meetingId'      => '1',
			'userId'         => '2',
			'title'          => 'دبیر جلسه',
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now()

		]);

		DB::table('agenda')->insert([

			'meetingId'      => '1',
			'userId'         => '4',
			'title'          => 'هزینه های مورد نیاز',
			'value_time' => '3',
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now()

		]);

		DB::table('agenda')->insert([

			'meetingId'      => '1',
			'userId'         => '3',
			'title'          => 'ارزش های نرم افزار',
			'value_time' => '10',
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now()

		]);

	}
}
