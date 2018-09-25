<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //
    protected $fillable = ['email', 'password'];

    public function organization() {
        return $this->belongsTo('App\Organization');
    }
}
