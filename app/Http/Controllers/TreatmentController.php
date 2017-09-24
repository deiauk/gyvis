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
            "temperature" => "required|numeric",
            "pulse" => "required|numeric",
            "breath" => "required",
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

        if(!$this->isEnoughMedicine($medicine->balance, $request->input('quantity'))) {
            return response()->json(["quantity" => ["Maksimalus esamas kiekis: " .  $medicine->balance]], 200);
        }

        if($medicine) {
            $medicine->consumed = $medicine->consumed + $request->input('quantity');
            $medicine->balance = $medicine->quantity - $medicine->consumed;
            $medicine->save();
        } else {
            return response()->json(["medicine" => ["Šis preparatas neegzistuoja."]], 200);
        }

        $treatment = Treatment::create([
            "date" => $request->input('date'),
            "animalNumber" => $request->input('number'),
            "animalType" => $request->input('breed'),
            "age" => $request->input('age'),
            "color" => $request->input('color'),
            "sickDate" => $request->input('sickdate'),
            "animalResearchData" => "",
            "pulse" => $request->input('pulse'),
            "temperature" => $request->input('temperature'),
            "breath" => $request->input('breath'),
            "diagnosis" => $request->input('diagnosis'),
            "treatmentAndDirections" => $request->input('treatment'),
            "result" => $request->input('end'),
            "notes" => $request->input('info'),
            "quantity" => $request->input('quantity'),
        ]);
        $treatment->medicine()->associate($medicine);
        $treatment->save();
        return response()->json([], 201);
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
            "temperature" => "required|numeric",
            "pulse" => "required|numeric",
            "breath" => "required",
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
            $treatment->breath = $request->input('breath');
            $treatment->diagnosis = $request->input('diagnosis');
            $treatment->treatmentAndDirections = $request->input('treatment');
            $treatment->result = $request->input('end');
            $treatment->notes = $request->input('notes');

            // reset used medicine
            $backupData = [$treatment->medicine_id, $treatment->quantity];

            if(!$this->unsetMedicine($treatment->medicine_id, $treatment->quantity)) {
                return response()->json(["medicine" => ["Medikamentas yra ištrintas iš medikamentų žurnalo"]], 200);
            }

            $medicine = $this->setMedicine($request->input('medicine'), $request->input('quantity'));

            if(is_array($medicine)) {
                $this->setMedicine($backupData[0], $backupData[1]);
                switch ($medicine['code']) {
                    case 2:
                        return response()->json(["medicine" => ["Medikamentas yra ištrintas iš medikamentų žurnalo"]], 200);
                        break;
                    case 3:
                        return response()->json(["quantity" => ["Maksimalus panaudojamas medikamento kiekis: " . $medicine["data"]]], 200);
                        break;
                }
            }
            if ($treatment->medicine_id != $request->input('medicine')) {
                $treatment->medicine()->associate($medicine);
            }
            $treatment->quantity = $request->input('quantity');
            $treatment->save();
        }
        else {
            return response()->json([], 200);
        }
        return response()->json([], 201);
    }

    private function unsetMedicine($id, $quantity)
    {
        $medicine = Medicine::find($id);
        if(is_null($medicine)) {
            return false;
        }
        $medicine->consumed = $medicine->consumed - $quantity;
        $medicine->balance = $medicine->quantity - $medicine->consumed;
        $medicine->save();
        return true;
    }

    private function setMedicine($id, $quantity)
    {
        $medicine = Medicine::find($id);
        if(is_null($medicine)) {
            return ["code" => 2];
        }
        else {
            if($medicine->balance < $quantity) {
                return ["code" => 3, "data" => $medicine->balance];
            }
        }
        $medicine->consumed = $medicine->consumed + $quantity;
        $medicine->balance = $medicine->quantity - $medicine->consumed;
        $medicine->save();
        return $medicine;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Treatment $treatment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Treatment $treatment)
    {
        $treatment = Treatment::find(request('id'));
        if(!$this->unsetMedicine($treatment->medicine_id, $treatment->quantity)) {
            return response()->json(["medicine" => ["Medikamentas yra ištrintas iš medikamentų žurnalo"]], 200);
        }
        $treatment->delete();
        return response()->json([], 202);
    }

    function getData(Treatment $treatment)
    {
        $medicines = Medicine::where('balance', '>', 0);
        $medicine = Medicine::where('id', '=', $treatment->medicine_id);

        $result = $medicines->union($medicine)->orderBy('id', 'asc')->get();

        return response()->json(["treatment" => $treatment->toArray(), "medicines" => $result->toArray()], 200);
    }

    function isEnoughMedicine($balance, $quantity)
    {
        $quantity = $quantity < 0 ? -$quantity : $quantity;
        if((float)$balance < (float)$quantity) {
            return false;
        }
        return true;
    }
}
