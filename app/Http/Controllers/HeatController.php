<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Heat;
use App\Animal;

class HeatController extends Controller
{
    public function index()
    {
        $search = '';
        $animal = null;
        if(request('search') == null || is_null(request('search'))) {
            $heats = Heat::all();
        }
        else {
            $search = request('search');

            $animal = Animal::where('number', 'LIKE', $search . '%')
                ->where('sex', '=', 2)
                ->first();

            $heats = $animal->heats;
        }
        $numbers = Animal::where('sex', '=', 2)->get();
        return view('menu.heats', compact('heats', 'search', 'numbers', 'animal'));
    }
    public function store()
    {
        $validator = $this->validator();
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $heat = Heat::create([
            "animal_id" => -1,
            "calving_date" => request('calving_date'),
            "heat_date" => request('heat_date'),
            "calving_date_expected" => request('calving_date_expected'),
            "notes" => request('notes'),
        ]);
        $heat->animal()->associate(request('number'));
        $heat->save();

        return response()->json([], 201);
    }
    public function update()
    {
        $validator = $this->validator();
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $heat = Heat::find(request('rowId'));
        $heat->calving_date = request('calving_date');
        $heat->heat_date = request('heat_date');
        $heat->calving_date_expected = request('calving_date_expected');
        $heat->notes = request('notes');
        $heat->animal()->associate(request('number'));
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

        $animals = Animal::where('number', 'LIKE', request('term') . '%')
            ->where('sex', '=', 2)
            ->take(5)
            ->get();

        foreach($animals as $animal) {
            $results[] = [
                "id" => $animal->id,
                "value" => $animal->number
            ];
        }
        return response()->json($results);
    }
    private function validator()
    {
        return Validator::make(request()->all(), [
            "number" => "required|min:0",
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
