<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeatController extends Controller
{
    public function index()
    {
        $heats = [];
        return view('menu.heat', compact('heats'));
    }
}
