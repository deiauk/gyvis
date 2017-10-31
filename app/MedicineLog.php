<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicineLog extends Model
{
    protected $table = 'medicine_logs';
    protected $fillable = [
        'id', 'medicine_id', 'type', 'category', 'quantity', 'used', 'registration_num'
    ];

    public $timestamps = false;

    public function scopeLast($query)
    {
        return $query->orderBy('id', 'desc')
            ->first();
    }

    public function medicine()
    {
        return $this->belongsTo('App\\Medicine');
    }
}
