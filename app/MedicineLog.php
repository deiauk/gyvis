<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicineLog extends Model
{
    protected $fillable = [
        'id', 'medicine_id', 'type', 'category', 'quantity', 'used'
    ];

    public $timestamps = false;

    public function scopeLast($query)
    {
        return $query->orderBy('id', 'desc')
            ->first();
    }
}
