<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    //
    public $timestamps = false;

    public function heats()
    {
        return $this->hasMany('App\\Heat');
    }
    public static function dateRange($dateRange)
    {
        return static::whereBetween('filldate', $dateRange);
    }
}
