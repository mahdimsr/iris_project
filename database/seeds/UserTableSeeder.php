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
			'password'   => bcrypt('qwerty'),
			'phone'      => '09321234567',
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now()

		]);

		DB::table('user')->insert([

			'name'       => 'سارا بیات',
			'postId'     => '2',
			'genre'      => 'FEMALE',
            'email'      => 'qwerty@gmail.com',
            'password'   => bcrypt('qwerty'),
			'phone'      => '09301234321',
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now()

		]);

		DB::table('user')->insert([

			'name'       => 'مهدی منصوری',
			'postId'     => '4',
			'genre'      => 'MALE',
            'email'      => 'qwerty1@gmail.com',
            'password'   => bcrypt('qwerty'),
			'phone'      => '09351603029',
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now()

		]);

		DB::table('user')->insert([

			'name'       => 'سامان رضایی',
			'postId'     => '4',
			'genre'      => 'MALE',
			'password'   => bcrypt('qwerty'),
            'email'      => 'qwerty2@gmail.com',
            'phone'      => '09123456789',
			'created_at' => \Carbon\Carbon::now(),
			'updated_at' => \Carbon\Carbon::now()

		]);

        DB::table('user')->insert([

            'name'       => 'علی قاسمی',
            'postId'     => '1',
            'genre'      => 'MALE',
            'email'      => 'qwerty3@gmail.com',
            'password'   => bcrypt('qwerty'),
            'phone'      => '09134744677',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()

        ]);
	}
}
