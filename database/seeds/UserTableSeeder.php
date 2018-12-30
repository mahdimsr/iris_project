<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('user')->insert([

			'name'       => 'سارا بیات',
			'postId'     => '2',
			'genre'      => 'FEMALE',
			'password'   => '1234',
			'phone'      => '09301234321',
			'slug'       => str_slug('سارا بیات'),
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now()

		]);
	}
}
