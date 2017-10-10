<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Heat extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public function animal()
    {
        return $this->belongsTo('App\\Animal');
    }

    public static function dateRange($dateRange)
    {
        return static::whereBetween('calving_date', $dateRange);
    }
}
