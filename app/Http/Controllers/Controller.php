<?php namespace GestorImagenes\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	public function missingMethod($parameters = array())
	{
		abort(404);
	}
}
