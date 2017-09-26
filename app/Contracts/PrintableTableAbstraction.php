<?php

namespace App\Contracts;

abstract class PrintableTableAbstraction
{
    // unix timestamp format
    protected $dateRange;
    protected $data;

    public function setDateRange($dateRange)
    {
        $this->dateRange = [strtotime($dateRange[0]), strtotime($dateRange[1])];
    }
    public function getView($name, $data)
    {
        return view($name, compact('data'))->render();
    }
    public function getData()
    {
        return $this->data;
    }
}