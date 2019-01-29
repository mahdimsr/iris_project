<?php

use Illuminate\Database\Seeder;


class MessageTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('message')->insert([

			'title'       => 'اولین پیام از سمت شخص',
			'content'     => 'این پیام به طور پیش فرض در سامانه ثبت میشود',
			'sender_id'   => '2',
			'receiver_id' => '3',
			'created_at'  => \Carbon\Carbon::now(),

		]);

		DB::table('message')->insert([

			'title'       => 'اولین پیام سامانه',
			'content'     => 'این پیام به طور پیش فرض در سامانه ثبت میشود',
			'sender_id'   => '0',
			'receiver_id' => '3',
			'created_at'  => \Carbon\Carbon::now(),

		]);
	}
}
