<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    //
    public $timestamps = false;

    public function heat()
    {
        return $this->hasOne('App\\Heat');
    }
    public static function dateRange($dateRange)
    {
        return static::whereBetween('filldate', $dateRange);
    }
}
