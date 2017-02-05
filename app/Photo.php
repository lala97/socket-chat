<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

	protected $fillable=['imageName'];

    public function elan()
    {
    	return $this->belongsTo('App\Elan');
    }
}
