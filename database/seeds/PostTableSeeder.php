<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PostTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('post')->insert([

			'title' => 'مدیر',

		]);

		DB::table('post')->insert([

			'title' => 'دبیر جلسه',

		]);

		DB::table('post')->insert([

			'title'    => 'منشی',
			'parentId' => '1'

		]);

		DB::table('post')->insert([

			'title'    => 'کارمند',
			'parentId' => '1'

		]);


	}
}
