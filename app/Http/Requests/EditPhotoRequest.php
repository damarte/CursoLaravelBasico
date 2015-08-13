<?php namespace GestorImagenes\Http\Requests;

use GestorImagenes\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

use GestorImagenes\Album;
use GestorImagenes\Photo;

class EditPhotoRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$user = Auth::user();

		$id = $this->get('id');

		$photo = Photo::find($id);

		$album = $user->albums()->find($photo->album_id);

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
			'id' => 'required|exists:photos,id',
			'name' => 'required|max:255',
			'description' => 'required',
			'image' => 'image|max:20000',
		];
	}

}
