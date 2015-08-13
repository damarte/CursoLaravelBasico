<?php namespace GestorImagenes\Http\Requests;

use GestorImagenes\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class ShowPhotosRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$user = Auth::user();

		$album_id = $this->get('album_id');

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
			'album_id' => 'required'
		];
	}

}
