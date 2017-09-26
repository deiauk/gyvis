<?php

namespace App\Contracts;

abstract class PrintableTableInterface
{
    // unix timestamp format
    protected $dateFrom;
    protected $dateTo;

    public function setDateRange($from, $to)
    {
        $this->dateFrom = strtotime($from);
        $this->dateTo = strtotime($to);
    }
}