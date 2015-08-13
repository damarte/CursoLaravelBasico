<?php namespace GestorImagenes\Http\Requests;

use GestorImagenes\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class DeleteAlbumRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$user = Auth::user();

		$album_id = $this->get('id');

		$album = $user->albums()->find($album_id);

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
			'id' => 'required|exists:albums,id'
		];
	}

}
