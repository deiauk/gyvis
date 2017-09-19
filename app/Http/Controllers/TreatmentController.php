<?php

namespace App\Http\Controllers;

use App\Medicine;
use App\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            "date" => "required|date",
            "number" => "required",
            "breed" => "required",
            "age" => "required|numeric",
            "color" => "required",
            "sickdate" => "required|date",
            "temperature" => "required",
            "pulse" => "required",
            "diagnosis" => "required",
            "treatment" => "required",
            "medicine" => "required|numeric|min:1",
            "quantity" => "required|numeric|min:0",
            "end" => "required",
            "info" => "required",
        ]);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $medicine = Medicine::find($request->input('medicine'));
        if($medicine) {
            $medicine->consumed = $medicine->consumed + $request->input('medicineQuantity');
            $medicine->balance = $medicine->quantity - $medicine->consumed;
            $medicine->save();
        }

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
        $validator = Validator::make($request->all(), [
            "date" => "required|date",
            "number" => "required",
            "breed" => "required",
            "age" => "required|numeric",
            "color" => "required",
            "sickdate" => "required|date",
            "temperature" => "required",
            "pulse" => "required",
            "diagnosis" => "required",
            "treatment" => "required",
            "medicine" => "required|numeric|min:1",
            "quantity" => "required|numeric|min:0",
            "end" => "required",
            "notes" => "required",
        ]);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $treatment = Treatment::find($request->input('rowId'));
        if($treatment) {
            $treatment->date = $request->input('date');
            $treatment->animalNumber = $request->input('number');
            $treatment->animalType = $request->input('breed');
            $treatment->age = $request->input('age');
            $treatment->color = $request->input('color');
            $treatment->sickDate = $request->input('sickdate');
            $treatment->pulse = $request->input('pulse');
            $treatment->diagnosis = $request->input('diagnosis');
            $treatment->treatmentAndDirections = $request->input('treatment');
            $treatment->result = $request->input('end');
            $treatment->notes = $request->input('notes');

            // if medicine ID is different
            if ($treatment->medicine != $request->input('medicine')) {
                // reset medicine quantity to previous state
                $this->calcMedicine($treatment->medicine, -$treatment->quantity);
                // set new medicine
                $treatment->medicine = $request->input('medicine');
                // set new medicine quantity
                $this->calcMedicine($treatment->medicine, $request->input('quantity'));
            } // if ID is not different
            else {
                // if new quantity is lower
                if ($treatment->quantity > $request->input('quantity')) {
                    $this->calcMedicine($treatment->medicine,
                        -($request->input('quantity') - $treatment->quantity));
                } // if new quantity is larger
                else {
                    if ($treatment->quantity < $request->input('quantity')) {
                        $this->calcMedicine($treatment->medicine,
                            $treatment->quantity - $request->input('quantity'));
                    }
                }
            }
            $treatment->quantity = $request->input('quantity');
            $treatment->save();
        }
        return response()->json([], 201);
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
