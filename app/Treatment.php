<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Medicine;

class Treatment extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public function medicine() {
        return $this->belongsTo('App\\Medicine');
    }
}
