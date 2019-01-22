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

			'name'       => 'لیلا مرادی',
			'postId'     => '3',
            'genre'      => 'FEMALE',
            'email'      => 'general@jam1.com',
			'password'   => '1234',
			'phone'      => '09321234567',
			'slug'       => str_slug('لیلا مرادی'),
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now()

		]);

		DB::table('user')->insert([

			'name'       => 'سارا بیات',
			'postId'     => '2',
			'genre'      => 'FEMALE',
            'email'      => 'qwerty@gmail.com',
            'password'   => '1234',
			'phone'      => '09301234321',
			'slug'       => str_slug('سارا بیات'),
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now()

		]);

		DB::table('user')->insert([

			'name'       => 'مهدی منصوری',
			'postId'     => '4',
			'genre'      => 'MALE',
            'email'      => 'qwerty1@gmail.com',
            'password'   => '1234',
			'phone'      => '09351603029',
			'slug'       => str_slug('مهدی منصوری'),
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now()

		]);

		DB::table('user')->insert([

			'name'       => 'سامان رضایی',
			'postId'     => '4',
			'genre'      => 'MALE',
			'password'   => '1234',
            'email'      => 'qwerty2@gmail.com',
            'phone'      => '09123456789',
			'slug'       => str_slug('سامان رضایی'),
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now()

		]);
	}
}
