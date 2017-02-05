<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elantype extends Model
{
   public function elanlar()
   {
      return $this->hasMany('App\Elan','type_id');
   }
}
