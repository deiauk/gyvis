<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Validator;
use App\Heat;
use App\Animal;

class HeatController extends Controller
{
    public function index()
    {
        $search = '';
        $animal = null;
        $numbers = null;
        if(request('search') == null || is_null(request('search'))) {
            $heats = Heat::orderBy('animal_id', 'ASC')
                ->orderBy('calving_date_expected', 'ASC')
                ->paginate(30);
            $numbers = Animal::where('sex', '=', 2)->get();
        }
        else {
            $search = request('search');

            $animal = Animal::where('number', 'LIKE', $search . '%')
                ->where('sex', '=', 2)
                ->first();

            $heats = $animal->heats;

            $numbers = [$animal];
        }
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
            "calving_date" => "required_without:heat_date|sometimes|nullable|date",
            "heat_date" => "required_without:calving_date|sometimes|nullable|date",
            "calving_date_expected" => "required|date",
        ]);
    }
    public function getData(Heat $heat) {
        return $heat;
    }
    public function indexCalving()
    {
        $search = '';
        if(!empty(request('search'))) {
            $this->validate(request(), [
                'search' => 'numeric'
            ]);
            $search = request('search');
        }

        $months = [];

        $year = empty($search) ? date('Y') : $search;
        for($i = 0; $i < 12; $i++) {
            $months[$i] = [];
            $heats = Heat::whereYear('calving_date_expected', '=', $year)
                ->whereMonth('calving_date_expected', '=', ($i+1))
                ->get();

            foreach ($heats as $heat) {
                if(empty($months[$i][$heat->animal_id])) {
                    $months[$i][$heat->animal_id][0] = $heat;
                }
                else {

                    if(is_null($months[$i][$heat->animal_id][0]->heat_date)) {
                        if(!is_null($heat->heat_date)) {
                            $months[$i][$heat->animal_id] = null;
                            $months[$i][$heat->animal_id][0] = $heat;
                        }
                        else {
                            $months[$i][$heat->animal_id][] = $heat;
                        }
                    }
                    else {
                        if(!is_null($heat->heat_date) && date('j', strtotime($months[$i][$heat->animal_id][0]->calving_date_expected)) < date('j', strtotime($heat->calving_date_expected))) {
                            $months[$i][$heat->animal_id] = null;
                            $months[$i][$heat->animal_id][0] = $heat;
                        }
                    }
                }
            }
        }

        return view('menu.calving', compact('months', 'search'));
    }
}
