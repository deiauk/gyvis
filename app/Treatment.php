<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Medicine;

class Treatment extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected $attributes = [
        'medicine_id' => null
    ];

    public function medicine() {
        return $this->belongsTo('App\\Medicine');
    }
    public static function dateRange($dateRange)
    {
        return static::whereBetween('date', $dateRange);
    }
}
