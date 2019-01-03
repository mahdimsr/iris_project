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

			//id 1
			'persianTitle' => 'مدیر',
			'englishTitle' => 'manager',

		]);

		DB::table('post')->insert([

			//id 2

			'persianTitle' => 'دبیر جلسه',
			'englishTitle' => 'actuary',

		]);

		DB::table('post')->insert([

			//id 3

			'persianTitle'    => 'منشی',
			'englishTitle'    => 'secretary',
			'parentId' => '1'

		]);

		DB::table('post')->insert([

			//id 4

			'persianTitle'    => 'کارمند',
			'englishTitle'    => 'clerk',
			'parentId' => '1'

		]);


	}
}
