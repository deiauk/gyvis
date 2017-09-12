<?php

namespace App\Http\Controllers;

use App\Animal;
use Illuminate\Http\Request;
use DateTime;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = Animal::paginate(15);
        return view('menu.animals', ['animals' => $animals]);
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
        $data = $request->all();
//        $this->validate($request, [
//            'title' => 'required|max:100',
//            'body' => 'required|min:10'
//        ]);

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
        $animal->save();
        return 1;
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
        $data = $request->all();
        dump($data);
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
        $animal->save();
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

    function getData($id)
    {
        $animal = Animal::find($id);
        return $animal;
    }
}
