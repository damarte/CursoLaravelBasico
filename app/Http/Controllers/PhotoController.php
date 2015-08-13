<?php namespace GestorImagenes\Http\Controllers;

use GestorImagenes\Http\Requests\ShowPhotosRequest;

use GestorImagenes\Album;
use GestorImagenes\Photo;
use GestorImagenes\Http\Requests\AddPhotoRequest;
use GestorImagenes\Http\Requests\EditPhotoRequest;
use GestorImagenes\Http\Requests\DeletePhotoRequest;
use GestorImagenes\Http\Requests;

use Carbon\Carbon;

class PhotoController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getIndex(ShowPhotosRequest $request)
	{
		$album_id = $request->get('album_id');

		$photos = Album::find($album_id)->photos;

		return view('photos.index', ['photos' => $photos, 'album_id' => $album_id]);
	}

	public function getAdd($album_id)
	{
		return view('photos.add', ['album_id' => $album_id]);
	}

	public function postAdd(AddPhotoRequest $request)
	{
		$album_id = $request->get('album_id');

		$image = $request->file('image');

		$url = '/img/';
		$name = sha1(Carbon::now()).'.'.$image->guessExtension();

		$image->move(getcwd().$url, $name);

		Photo::create([
			'name' => $request->get('name'),
			'description' => $request->get('description'),
			'url' => $url.$name,
			'album_id' => $album_id,
			]);

		return redirect('/photos?album_id='.$album_id)->with('success', 'Photo created');
	}

	public function getEdit($id)
	{
		$photo = Photo::find($id);

		return view('photos.edit', ['photo' => $photo]);
	}

	public function postEdit(EditPhotoRequest $request)
	{
		$photo = Photo::find($request->get('id'));

		$photo->name = $request->get('name');
		$photo->description = $request->get('description');

		if($request->hasFile('image')){
			$image = $request->file('image');

			$url = '/img/';
			$name = sha1(Carbon::now()).'.'.$image->guessExtension();

			$image->move(getcwd().$url, $name);

			//Remove last
			$last_url = getcwd().$photo->url;

			if(file_exists($last_url)){
				unlink(realpath($last_url));
			}

			$photo->url = $url.$name;
		}

		$photo->save();

		return redirect('/photos?album_id='.$photo->album_id)->with('success', 'Photo updated');
	}

	public function postDelete(DeletePhotoRequest $request)
	{
		$photo = Photo::find($request->get('id'));

		//Remove last
		$last_url = getcwd().$photo->url;

		if(file_exists($last_url)){
			unlink(realpath($last_url));
		}

		$photo->delete();

		return redirect('/photos?album_id='.$photo->album_id)->with('success', 'Photo removed');
	}



}
