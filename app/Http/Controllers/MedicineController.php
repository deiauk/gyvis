<?php

namespace App\Http\Controllers;

use App\Medicine;
use App\MedicineCategorie;
use App\MedicineLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category)
    {
        $search = '';
        $medicine = null;
        $logs = null;

        if(!is_null(request('search'))) {
            $search = request('search');

            $medicine = Medicine::type($category)
                ->where('from', 'like', '%' . $search . '%')
                ->first();

            if($medicine) {
                $logs = Medicine::with('log')
                    ->find($medicine->medicine_id)
                    ->log()
                    ->orderBy('id', 'asc')
                    ->get();
            }
        }

        return view('menu.medicines', compact('medicine', 'logs', 'category', 'search'));
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
            "filldate" => "required|date",
            "medicname" => "required",
            "productiondate" => "required|date",
            "expirydate" => "required|date",
            "series" => "required",
            //"patientregistrationnr" => "required",
            "quantity" => "required|numeric|min:0",
            "consumed" => "required|numeric|min:0",
            "medicine_category" => "required|numeric",
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
////        $this->validate($request, [
////            'title' => 'required|max:100',
////            'body' => 'required|min:10'
////        ]);
//
//        $medicine = new Animal();
//        $medicine->number = $data['number'];
//        $medicine->name = $data['name'];
//        $medicine->livebeing = $data['livebeing'];
//        $medicine->breedName = $data['breed'];
//        $medicine->sex = $data['gender'];
//        $medicine->birthday = $data['birthday'];
//        $medicine->color = $data['color'];
//        $medicine->mother = $data['mother'];
//        $medicine->father = $data['father'];
//        $medicine->comment = $data['desc'];
//        $medicine->save();
//        return 1;

        /*
         *  var newMedicament = {
            'filldate' : filldate,
            'medicname' : medicname,
            'productiondate' : productiondate,
            'expirydate' : expirydate,
            'series' : series,
            'patientregistrationnr' : patientregistrationnr,
            'quantity' : quantity,
            'consumed' : consumed
        };
         */

        $data = $request->all();

        $medicament = new Medicine();
        $medicament->filldate = $data['filldate'];
        $medicament->from = $data['medicname'];
        $medicament->productiondate = $data['productiondate'];
        $medicament->expirydate = $data['expirydate'];
        $medicament->series = $data['series'];
        $medicament->patientregistrationnr = $data['patientregistrationnr'];
        $medicament->quantity = $data['quantity'];
        $medicament->consumed = $data['consumed'];
        $medicament->balance = $data['quantity'] - $data['consumed'];
        $medicament->save();

        $category = MedicineCategorie::create([
            "type" => $request->input('medicine_category'),
            "medicine_id" => 0
        ]);
        $category->medicine()->associate($medicament);
        $category->save();

        return response()->json($medicament->toArray(), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medicine $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicine $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicine $medicine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Medicine $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "filldate" => "required|date",
            "medicname" => "required",
            "productiondate" => "required|date",
            "expirydate" => "required|date",
            "series" => "required",
            //"patientregistrationnr" => "required",
            "quantity" => "required|numeric|min:0",
            "consumed" => "required|numeric|min:0",
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $data = $request->all();
        $medicine = Medicine::find($data['rowId']);
        $medicine->filldate = $data['filldate'];
        $medicine->from = $data['medicname'];
        $medicine->productiondate = $data['productiondate'];
        $medicine->expirydate = $data['expirydate'];
        $medicine->series = $data['series'];
        $medicine->patientregistrationnr = $data['patientregistrationnr'];
        $medicine->quantity = $data['quantity'];
        $medicine->consumed = $data['consumed'];
        $medicine->balance = $data['quantity'] - $data['consumed'];
        $medicine->save();
        return response()->json([], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicine $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine)
    {
        //
    }

    function delete(Medicine $medicine)
    {
        $id = $medicine->id;
        $medicine->category()->delete();
        $medicine->delete();
        return $id;
    }

    public function getData($medicine)
    {
        $medicine = Medicine::find($medicine);
        if($medicine == null) {
            return response()->json([], 200);
        }
        return $medicine->first();
    }

    public function autocomplete($category)
    {
        $results = [];

        if(is_null(request('term'))) {
            $medicines = Medicine::type($category)
                ->orderBy('from', 'desc')
                ->get();
        }
        else {
            $medicines = Medicine::type($category)
                ->where('from', 'LIKE', '%' . request('term') . '%')
                ->take(5)
                ->get();
        }

        foreach($medicines as $medicine) {
            $results[] = [
                "id" => $medicine->id,
                "value" => $medicine->from
            ];
        }
        return response()->json($results);
    }

    public function add(Request $request, Medicine $medicine)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => "required|numeric|min:0"
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $medicine->quantity += request('quantity');
        $medicine->balance += request('quantity');
        $medicine->save();

        if(count($medicine->log) > 0) {
            $lastRecord = $medicine->log()->last();

            if($lastRecord != null) {
                $quantity = $lastRecord->quantity + $lastRecord->used;
            }
        }

        MedicineLog::create([
            'medicine_id' => $medicine->id,
            'type' => 2,
            'category' => $medicine->category[0]->type,
            'quantity' => $quantity,
            'used' => $request->input('quantity'),
            'registration_num' => -1
        ]);

        return response()->json([], 201);
    }
}
