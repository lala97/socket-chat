<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elan extends Model
{
  protected $fillable=['title','status','user_id','image','about','type_id','phone','lat','lng','name','org','nov','email','location','deadline'];  // lat lng elave etmeli
  
   protected $table='els';

    public function elan_type()
    {
       return $this->belongsTo('App\Elantype','type_id');
    }

    public function user()
    {
       return $this->belongsTo('App\User','user_id');
    }

    public function qarsiliqlar()
    {
       return $this->hasMany('App\Qarsiliq','elan_id');
    }
     public function shekiller()
    {
      return $this->hasMany('App\Photo','els_id');
    }
}
