<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EventTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */

	// type : ['SOLAR','LUNAR','GREGORIAN']


	public function run()
	{
		$year = 2019;

		DB::table('event')->insert([

			'title'     => 'آغاز عید نوروز',
			'type'      => 'SOLAR',
			'isHoliday' => true,
			'date'      => \Illuminate\Support\Carbon::create($year , 3 , 21)

		]);
	}
}
