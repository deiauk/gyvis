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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $medicine = Medicine::find($request->input('medicine'));
        $medicine->consumed = $medicine->consumed + $request->input('medicineQuantity');
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
            "medicine" => $request->input('medicine'),
            "quantity" => $request->input('quantity'),
        ]);
        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Treatment $treatment
     * @return \Illuminate\Http\Response
     */
    public function show(Treatment $treatment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Treatment $treatment
     * @return \Illuminate\Http\Response
     */
    public function edit(Treatment $treatment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Treatment $treatment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Treatment $treatment)
    {
        $treatment = Treatment::find($request->input('rowId'));
        $treatment->date = $request->input('date');
        $treatment->animalNumber = $request->input('animalNumber');
        $treatment->animalType = $request->input('breed');
        $treatment->age = $request->input('age');
        $treatment->color = $request->input('color');
        $treatment->sickDate = $request->input('sickDate');
        $treatment->pulse = $request->input('pulse');
        $treatment->diagnosis = $request->input('diagnosis');
        $treatment->treatmentAndDirections = $request->input('treatmentAndDirections');
        $treatment->result = $request->input('result');
        $treatment->notes = $request->input('notes');

        // if medicine ID is different
        if ($treatment->medicine != $request->input('medicine')) {
            // reset medicine quantity to previous state
            $this->calcMedicine($treatment->medicine, -$treatment->quantity);
            // set new medicine
            $treatment->medicine = $request->input('medicine');
            // set new medicine quantity
            $this->calcMedicine($treatment->medicine, $request->input('medicineQuantity'));
        } // if ID is not different
        else {
            // if new quantity is lower
            if ($treatment->quantity > $request->input('medicineQuantity')) {
                $this->calcMedicine($treatment->medicine,
                    -($request->input('medicineQuantity') - $treatment->quantity));
            } // if new quantity is larger
            else {
                if ($treatment->quantity < $request->input('medicineQuantity')) {
                    $this->calcMedicine($treatment->medicine,
                        $treatment->quantity - $request->input('medicineQuantity'));
                }
            }
        }
        $treatment->quantity = $request->input('medicineQuantity');
        $treatment->save();
        return 1;
    }

    private function calcMedicine($id, $quantity)
    {
        $medicine = Medicine::find($id);
        if ($medicine) {
            $medicine->consumed = $medicine->consumed + $quantity;
            $medicine->balance = $medicine->quantity - $medicine->consumed;
            $medicine->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Treatment $treatment
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
