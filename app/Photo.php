<?php namespace GestorImagenes;

use Illuminate\Database\Eloquent\Model;
use GestorImagenes\Album;

class Photo extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'photos';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id', 'name', 'description', 'url', 'album_id'];

	public function album()
    {
        return $this->belongsTo('GestorImagenes\Album', 'album_id', 'id');
    }

}
