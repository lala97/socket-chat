<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qarsiliq extends Model
{
    public function user()
    {
       return $this->belongsTo('App\User');
    }

    public function elan()
    {
       return $this->belongsTo('App\Elan','elan_id');
    }
}
