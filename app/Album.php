<?php namespace GestorImagenes;

use Illuminate\Database\Eloquent\Model;
use GestorImagenes\User;
use GestorImagenes\Photo;

class Album extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'albums';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id', 'name', 'description', 'user_id'];

	public function user()
    {
        return $this->belongsTo('GestorImagenes\User', 'user_id', 'id');
    }

	public function photos()
    {
        return $this->hasMany('GestorImagenes\Photo');
    }
}
