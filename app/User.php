<?php

namespace App;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    public function guardian()
     {
         return $this->hasOne('App\Phone');
     }

     public function school()
     {
         return $this->belongsTo('App\School');
     }

     public function detail()
     {
         return $this->hasOne('App\UserDetail');
     }
}
