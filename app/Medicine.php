<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    public $timestamps = false;

    public function treatment() {
        return $this->hasMany('App\\Treatment');
    }
}
