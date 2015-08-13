<?php namespace GestorImagenes\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use GestorImagenes\Http\Requests\AddAlbumRequest;
use GestorImagenes\Http\Requests\EditAlbumRequest;
use GestorImagenes\Http\Requests\DeleteAlbumRequest;
use GestorImagenes\Album;

class AlbumController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getIndex()
	{
		$user = Auth::user();

		$albums = $user->albums;

		return view('albums.index', ['albums' => $albums]);
	}

	public function getAdd()
	{
		return view('albums.add');
	}

	public function postAdd(AddAlbumRequest $request)
	{
		$user = Auth::user();

		Album::create([
			'name' => $request->get('name'),
			'description' => $request->get('description'),
			'user_id' => $user->id,
			]);

		return redirect('/albums')->with('success', 'Album created');
	}

	public function getEdit($id)
	{
		$album = Album::find($id);

		return view('albums.edit', ['album' => $album]);
	}

	public function postEdit(EditAlbumRequest $request)
	{
		$album = Album::find($request->get('id'));
		$album->name = $request->get('name');
		$album->description = $request->get('description');

		$album->save();

		return redirect('/albums')->with('success', 'Album updated');
	}

	public function postDelete(DeleteAlbumRequest $request)
	{
		$album = Album::find($request->get('id'));

		foreach ($album->photos() as $photo) {
			//Remove last
			$last_url = getcwd().$photo->url;

			if(file_exists($last_url)){
				unlink(realpath($last_url));
			}
		}
		$album->photos()->delete();
		$album->delete();

		return redirect('/albums')->with('success', 'Album removed');
	}

}
