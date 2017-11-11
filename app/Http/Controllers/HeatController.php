<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Validator;
use App\Heat;
use App\CalvingStat;
use App\Animal;

class HeatController extends Controller
{
    public function index()
    {
        $search = '';
        $animal = null;
        $numbers = null;
        if (request('search') == null || is_null(request('search'))) {
            $heats = Heat::orderBy('animal_id', 'ASC')
                ->orderBy('id', 'ASC')
                ->paginate(30);
            $numbers = Animal::where('sex', '=', 2)->get();
        } else {
            $search = request('search');

            $animal = Animal::where('number', 'LIKE', $search . '%')
                ->where('sex', '=', 2)
                ->first();

            $heats = $animal->heats()->orderBy('id', 'ASC')->get();

            $numbers = [$animal];
        }
        return view('menu.heats', compact('heats', 'search', 'numbers', 'animal'));
    }

    public function store()
    {
        $validator = $this->validator();
        if ($validator->fails()) {
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

        $stats = null;
        if (!is_null(request('calving_date')) && is_null(request('heat_date'))) {
            $stats = CalvingStat::create([
                "latest_heat" => $heat->id,
            ]);
            $heat->calvingStat()->associate($stats->id);
        } else {
            $heatBefore = Heat::orderBy('id', 'desc')->skip(1)->take(1)->get();
            $heat->calvingStat()->associate($heatBefore[0]->calving_stat_id);
            $heat->save();

            $stats = CalvingStat::find($heatBefore[0]->calving_stat_id)->first();
            $stats->latest_heat = $heat->id;
        }
        $heat->save();

        return response()->json([], 201);
    }

    public function update()
    {
        $validator = $this->validator();
        if ($validator->fails()) {
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

    public function delete(Heat $heat)
    {
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

        foreach ($animals as $animal) {
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

    public function getData(Heat $heat)
    {
        return $heat;
    }

    public function indexCalving()
    {
        $search = '';
        if (!empty(request('search'))) {
            $this->validate(request(), [
                'search' => 'numeric'
            ]);
            $search = request('search');
        }

        $year = empty($search) ? date('Y') : $search;
        $calvingStat = CalvingStat::all();
        $heats = [];
        foreach ($calvingStat as $item) {
            $heats[] = $item->latestHeat($year);
        }
        $months = [];
        for($i=0;$i<12;$i++) {
            $months[$i] = [];
        }
        foreach($heats as $heat) {
            if(date('Y', strtotime($heat->calving_date_expected)) == $year) {
                $month = date('n', strtotime($heat->calving_date_expected));
                $months[$month-1][] = $heat;
            }
        }

        return view('menu.calving', compact('months', 'search'));
    }
}
