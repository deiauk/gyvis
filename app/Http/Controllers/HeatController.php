<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Heat;

class HeatController extends Controller
{
    public function index()
    {
        $search = '';
        if(request('search') == null) {
            $heats = Heat::all();
        }
        else {
            $search = request('search');
            $heats = Heat::where('number', 'LIKE', $search . '%')->get();
        }
        return view('menu.heats', compact('heats', 'search'));
    }
    public function store()
    {
        $validator = $this->validator();
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        Heat::create(request()->all());

        return response()->json([], 201);
    }
    public function update()
    {
        $validator = $this->validator();
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        //Heat::create(request());
        $heat = Heat::find(request('rowId'));
        $heat->number = request('number');
        $heat->calving_date = request('calving_date');
        $heat->heat_date = request('heat_date');
        $heat->calving_date_expected = request('calving_date_expected');
        $heat->notes = request('notes');
        $heat->save();

        return response()->json([], 201);
    }
    public function delete(Heat $heat) {
        $id = $heat->id;
        $heat->delete();
        return $id;
    }
    public function autocomplete()
    {
        $results = [];
        $heats = Heat::where('number', 'LIKE', request('term') . '%')
            ->take(5)
            ->get();

        foreach($heats as $heat) {
            $results[] = [
                "id" => $heat->id,
                "value" => $heat->number
            ];
        }
        return response()->json($results);
    }
    private function validator()
    {
        return Validator::make(request()->all(), [
            "number" => "required",
            "calving_date" => "required|date",
            "heat_date" => "required|date",
            "calving_date_expected" => "required|date",
            "notes" => "required",
        ]);
    }
    public function getData(Heat $heat) {
        return $heat;
    }
}
