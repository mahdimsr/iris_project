<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		// $this->call(UsersTableSeeder::class);

		$this->call([

			PostTableSeeder::class,
			UserTableSeeder::class,
			MeetingTableSeeder::class,
			AgendaTableSeeder::class,
			TaskTableSeeder::class,
			EventTableSeeder::class,
			MessageTableSeeder::class

		]);
	}
}
