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

    public static function dateRangeExpected($dateRange)
    {
        return static::whereBetween('calving_date_expected', $dateRange);
    }

    public static function calvingsThisMonth()
    {
        return static::select('animal_id', \DB::raw('MAX(calving_date_expected)'))
            ->whereYear('calving_date_expected', '=', date('Y'))
            ->whereMonth('calving_date_expected', '=', date('j'))
            ->groupBy('animal_id')
            ->get();
    }
}
