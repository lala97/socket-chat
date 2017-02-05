<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

      /**
       * The attributes that are mass assignable.
       *
       * @var array
       */
    protected $fillable = ['username','name', 'email', 'password','phone','avatar'];

      /**
       * The attributes that should be hidden for arrays.
       *
       * @var array
       */
      protected $hidden = [
          'password', 'remember_token',
      ];
}
