<?php

namespace App\Repositories;

use App\Contracts\PrintableTableAbstraction;
use App\Medicine;

class MedicinesTable extends PrintableTableAbstraction
{
    public function __construct($category, $dateRange)
    {
        //$this->setDateRange($dateRange);
        $this->data = Medicine::type($category)->dateRange($dateRange)->orderBy('filldate', 'asc')->get();
    }
}