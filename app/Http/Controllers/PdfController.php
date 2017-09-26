<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\PdfRequest;
use Illuminate\Support\Facades\Validator;

class PdfController extends Controller
{
    private $directory = '\public\uploads\pdf\\';

    public function create($route, $category = null)
    {
        //dd(request()->all());
        $validator = Validator::make(request()->all(), [
            "startdate" => "required|date",
            "enddate" => "required|date",
        ]);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $dateRange = [request('startdate'), request('enddate')];

        $filename = $this->directory . uniqid() . '.pdf';

        if(isset($category)) {
            event(new PdfRequest($filename, $route, $dateRange, $category));
        }
        else {
            event(new PdfRequest($filename, $route, $dateRange));
        }

        $response = response()
            ->make(file_get_contents(base_path() . $filename), 201,
                [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="'. $route .'.pdf"'
                ]);

        unlink(base_path(). $filename);

        return $response;
    }
}
