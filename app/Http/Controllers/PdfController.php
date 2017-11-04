<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\PdfRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PdfController extends Controller
{
    private $directory = '\public\uploads\pdf\\';

    public function create($route, $category = null)
    {
        $validator = Validator::make(request()->all(), [
            "startdate" => "required_without:med|date",
            "enddate" => "required_without:med|date",
        ]);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        if (!File::exists(base_path() . $this->directory)) {
            File::makeDirectory(base_path() . $this->directory, $mode = 0777, true, true);
        }

        $dateRange = [request('startdate'), request('enddate')];

        $filename = $this->directory . uniqid() . '.pdf';

        $route = $route == "heat.search" ? "ruja" : $route;
        $route = ($route == "heat.calving.index" || $route == "heat.calving.search") ? "versiavimasis" : $route;
        $route = $route == "medicine.search" ? "medikamentai" : $route;

        $data['dateRange'] = $dateRange;

        if(isset($category)) {
            $data['category'] = $category;
        }
        if(!empty(request('search'))) {
            $data['search'] = request('search');
        }
        if(!empty(request('med'))) {
            $data['id'] = request('med');
        }

        event(new PdfRequest($filename, $route, $data));

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
