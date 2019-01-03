<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MeetingTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('meeting')->insert([

			'creatorId'  => '3',
			'title'      => 'جلسه سنجش نرم افزار',
			'place'      => 'دفتر امور مالی',
			'date'       => '2019-01-20 00:00:00 ',
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now(),

		]);
	}
}
