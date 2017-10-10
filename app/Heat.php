<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Heat extends Model
{
    public $timestamps = false;

    public static function dateRange($dateRange)
    {
        return static::whereBetween('calving_date', $dateRange);
    }
}
