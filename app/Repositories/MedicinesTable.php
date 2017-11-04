<?php

namespace App\Repositories;

use App\Contracts\PrintableTableAbstraction;
use App\Medicine;

class MedicinesTable extends PrintableTableAbstraction
{
    public function __construct($id)
    {
        $medicine = Medicine::with('log')->find($id);

        if($medicine) {
            $log = $medicine->log()->orderBy('id', 'asc')->get();
            $arr = [
                "medicine" => $medicine,
                "log" => $log
            ];
            $this->data = (object) $arr;
        }
    }
}