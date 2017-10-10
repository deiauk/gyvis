<?php

namespace App\Repositories;

use App\Contracts\PrintableTableAbstraction;
use App\Heat;

class HeatsTable extends PrintableTableAbstraction
{
    public function __construct($dateRange)
    {
        //$this->setDateRange($dateRange);
        $this->data = Heat::dateRange($dateRange)->orderBy('calving_date', 'asc')->get();
    }
}