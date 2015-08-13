<?php namespace GestorImagenes\Http\Controllers;

use GestorImagenes\Http\Requests\EditProfileRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getEdit()
	{
		return view('user.edit');
	}

	public function postEdit(EditProfileRequest $request)
	{
		$user = Auth::user();
		$name = $request->get('name');

		$user->name = $name;

		if($request->has('password')){
			$user->password = bcrypt($request->get('password'));
		}

		$user->save();

		return redirect('user/edit')->with('updated', 'Profile updated');
	}

}
