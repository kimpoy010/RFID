<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }


    public function section()
    {
        return $this->belongsTo('App\Section');
    }
}
