<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
  protected $fillable = ['city','username','name', 'email', 'password','phone','avatar'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'password','remember_token',
    ];
    public function elanlar()
    {
      return $this->hasMany('App\Elan','user_id');
    }

    public function qarsiliqlar()
    {
      return $this->hasMany('App\Qarsiliq');
    }
}
