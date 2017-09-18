<?php

namespace App\Http\Controllers;

use App\Medicine;
use App\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $treatments = Treatment::paginate(15);
        $medicines = Medicine::where('balance', '>', 0)->get();
        return view('menu.treatments', compact('treatments', 'medicines'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $medicine = Medicine::find($request->input('medicine'));
        $medicine->consumed = $medicine->consumed + 1;
        $medicine->balance = $medicine->quantity - $medicine->consumed;
        $medicine->save();

        Treatment::create([
            "date" => $request->input('date'),
            "animalNumber" => $request->input('number'),
            "animalType" => $request->input('breed'),
            "age" => $request->input('age'),
            "color" => $request->input('color'),
            "sickDate" => $request->input('sickdate'),
            "animalResearchData" => "",
            "pulse" => $request->input('pulse'),
            "breath" => "",
            "diagnosis" => $request->input('diagnosis'),
            "treatmentAndDirections" => $request->input('treatment'),
            "result" => $request->input('end'),
            "notes" => $request->input('info'),
        ]);
        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function show(Treatment $treatment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function edit(Treatment $treatment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Treatment $treatment)
    {
        $treatment = Treatment::find($request->input('rowId'));
        dd($treatment);

//            [
//            "date" => $request->input('date'),
//            "animalNumber" => $request->input('number'),
//            "animalType" => $request->input('breed'),
//            "age" => $request->input('age'),
//            "color" => $request->input('color'),
//            "sickDate" => $request->input('sickdate'),
//            "animalResearchData" => "",
//            "pulse" => $request->input('pulse'),
//            "breath" => "",
//            "diagnosis" => $request->input('diagnosis'),
//            "treatmentAndDirections" => $request->input('treatment'),
//            "result" => $request->input('end'),
//            "notes" => $request->input('info'),
//        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Treatment $treatment)
    {
        $treatment->destroy(request('id'));
        return 1;
    }

    function getData(Treatment $treatment)
    {
        return $treatment;
    }
}
