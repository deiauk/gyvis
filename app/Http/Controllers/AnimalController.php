<?php

namespace App\Http\Controllers;

use App\Animal;
use App\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(auth()->user());
        $animals = Animal::paginate(15);
        $medicines = Medicine::where('balance', '>', 0)->get();
        return view('menu.animals', compact('animals', 'medicines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "number" => "required|unique:animals",
            "name" => "required",
            "livebeing" => "required",
            "breed" => "required",
            "gender" => "required|numeric",
            "birthday" => "required|date",
            "color" => "required",
            "mother" => "required",
            "father" => "required",
//            "desc" => "required|min:10",
            "filldate" => "required|date"
        ]);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $data = $request->all();

        $animal = new Animal();
        $animal->number = $data['number'];
        $animal->name = $data['name'];
        $animal->livebeing = $data['livebeing'];
        $animal->breedName = $data['breed'];
        $animal->sex = $data['gender'];
        $animal->birthday = $data['birthday'];
        $animal->color = $data['color'];
        $animal->mother = $data['mother'];
        $animal->father = $data['father'];
        $animal->comment = $data['desc'];
        $animal->filldate = $data['filldate'];
        $animal->save();
        return response()->json([], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Animal $animal
     * @return \Illuminate\Http\Response
     */
    public function show(Animal $animal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Animal $animal
     * @return \Illuminate\Http\Response
     */
    public function edit(Animal $animal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Animal $animal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            "number" => "required",
            "name" => "required",
            "livebeing" => "required",
            "breed" => "required",
            "gender" => "required|numeric",
            "birthday" => "required|date",
            "color" => "required",
            "mother" => "required",
            "father" => "required",
//            "desc" => "required|min:10",
            "filldate" => "required|date",
        ]);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $data = $request->all();

        $animal = Animal::find($data['rowId']);
        $animal->number = $data['number'];
        $animal->name = $data['name'];
        $animal->livebeing = $data['livebeing'];
        $animal->breedName = $data['breed'];
        $animal->sex = $data['gender'];
        $animal->birthday = $data['birthday'];
        $animal->color = $data['color'];
        $animal->mother = $data['mother'];
        $animal->father = $data['father'];
        $animal->comment = $data['desc'];
        $animal->filldate = $data['filldate'];
        $animal->save();
        return response()->json([], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Animal $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        dump($animal);
    }

    function delete(Request $request)
    {
        Animal::destroy($request->id);
        return $request->id;
    }

    function getData(Animal $animal)
    {
        return $animal;
    }
}
