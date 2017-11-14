<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalvingStat extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public function heats()
    {
        return $this->hasMany('App\\Heat');
    }

    public function latestHeat($year)
    {
        dd($this->heats()->find($this->latest_heat));
        return $this->heats()->find($this->latest_heat);
    }
}
