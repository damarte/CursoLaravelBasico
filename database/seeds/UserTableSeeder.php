<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use GestorImagenes\User;

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		for ($i=1; $i <= 50; $i++) {
			User::create([
				'name' => 'user'.$i,
				'email' => 'user'.$i.'@test.com',
				'password' => bcrypt('pass')
				]);
		}
	}

}
