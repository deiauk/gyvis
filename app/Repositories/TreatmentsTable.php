<?php

namespace App\Repositories;

use App\Contracts\PrintableTableAbstraction;
use App\Treatment;

class TreatmentsTable extends PrintableTableAbstraction
{
    public function __construct($dateRange)
    {
        //$this->setDateRange($dateRange);
        $this->data = Treatment::dateRange($dateRange)->orderBy('date', 'asc')->get();
    }
}