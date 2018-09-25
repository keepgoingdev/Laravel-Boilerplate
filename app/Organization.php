<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public function accounts() 
    {
        return $this->hasMany('App\Account');
    }

    public function submissions()
    {
        return $this->hasMany('App\Submission');
    }
}
