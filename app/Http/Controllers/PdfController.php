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
        $validator = Validator::make(request()->all(), [
            "startdate" => "required|date",
            "enddate" => "required|date",
        ]);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $dateRange = [request('startdate'), request('enddate')];

        $filename = $this->directory . uniqid() . '.pdf';

        $route = $route == "heat.search" ? "ruja" : $route;
        $route = ($route == "heat.calving.index" || $route == "heat.calving.search") ? "versiavimasis" : $route;

        if(isset($category)) {
            if(!empty(request('search'))) {
                event(new PdfRequest($filename, $route, $dateRange, $category, request('search')));
            }
            else {
                event(new PdfRequest($filename, $route, $dateRange, $category));
            }
        }
        else {
            if(!empty(request('search'))) {
                event(new PdfRequest($filename, $route, $dateRange, -1, request('search')));
            }
            else {
                event(new PdfRequest($filename, $route, $dateRange));
            }
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
