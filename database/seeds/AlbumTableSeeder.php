<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use GestorImagenes\Album;
use GestorImagenes\User;

class AlbumTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$users = User::all();
		$counter = 0;

		foreach ($users as $user) {
			for ($i=1; $i <= mt_rand(0, 15); $i++) {
				$counter++;

				Album::create([
					'name' => 'Album'.$counter,
					'description' => 'Description of album'.$counter,
					'user_id' => $user->id
					]);
			}
		}

	}

}
