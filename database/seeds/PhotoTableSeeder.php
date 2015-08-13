<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use GestorImagenes\Album;
use GestorImagenes\Photo;

class PhotoTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$albums = Album::all();
		$counter = 0;

		foreach ($albums as $album) {
			for ($i=1; $i <= mt_rand(0, 5); $i++) {
				$counter++;

				Photo::create([
					'name' => 'Photo'.$counter,
					'description' => 'Description of photo'.$counter,
					'album_id' => $album->id,
					'url' => '/img/text.png',
					]);
			}
		}
	}

}
