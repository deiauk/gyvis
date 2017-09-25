<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicineCategorie extends Model
{
    protected $table = 'medicine_categories';
    public $timestamps = false;

    protected $guarded = [];

    public function medicine() {
        return $this->belongsTo('App\\Medicine');
    }
}
