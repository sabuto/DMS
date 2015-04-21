<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model {

	protected $table = 'records';

	protected $fillable = ['creator', 'description', 'title', 'location', 'file'];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function revisions()
	{
		return $this->hasMany('App\Revision');
	}

}
