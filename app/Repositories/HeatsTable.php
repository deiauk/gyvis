<?php

namespace App\Repositories;

use App\Contracts\PrintableTableAbstraction;
use App\Heat;

class HeatsTable extends PrintableTableAbstraction
{
    public function __construct($search, $dateRange)
    {
        if(is_null($search)) {
            $this->data = Heat::dateRange($dateRange)->orderBy('calving_date', 'asc')->get();
        }
        else {
            $this->data = Heat::dateRange($dateRange)
                ->join('animals', 'heats.animal_id', '=', 'animals.id')
                ->where('animals.number', 'LIKE', $search . '%')
                ->get();
        }
    }
}