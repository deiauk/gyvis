<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    public $timestamps = false;

    public function treatment() {
        return $this->hasMany('App\\Treatment');
    }
    public function category() {
        return $this->hasMany('App\\MedicineCategorie');
    }
    public function getInstance() {
        return $this;
    }
    public static function type($type) {
        return static::join(
            'medicine_categories',
            'medicines.id', '=', 'medicine_categories.medicine_id'
        )->where('type', $type);
    }
}
