<?php

namespace App\Repositories;

use App\Contracts\PrintableTableAbstraction;
use App\Animal;

class AnimalsTable extends PrintableTableAbstraction
{
    public function __construct($dateRange)
    {
        //$this->setDateRange($dateRange);
        $this->data = Animal::dateRange($dateRange)->orderBy('filldate', 'asc')->get();
    }
}