<?php namespace GestorImagenes\Http\Requests;

use GestorImagenes\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class AddPhotoRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$user = Auth::user();

		$id = $this->get('album_id');

		$album = $user->albums()->find($id);

		if($album){
			return true;
		}
		else{
			return false;
		}
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => 'required|max:255',
			'description' => 'required',
			'image' => 'required|image|max:20000',
			'album_id' => 'required|exists:albums,id'
		];
	}

}
