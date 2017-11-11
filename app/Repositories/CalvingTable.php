<?php

namespace App\Repositories;

use App\Contracts\PrintableTableAbstraction;
use App\Heat;

class CalvingTable extends PrintableTableAbstraction
{
    public function __construct($dateRange)
    {
        $this->data = Heat::dateRangeExpected($dateRange)->orderBy('id', 'asc')->get();
    }
}