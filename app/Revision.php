<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model {

	public function record(){
		return $this->belongsTo('App\Record');
	}

}
