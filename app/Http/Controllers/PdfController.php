<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\PdfRequest;

class PdfController extends Controller
{
    private $directory = '\public\uploads\pdf\\';

    public function create($route, $category = null)
    {
        $filename = $this->directory . uniqid() . '.pdf';
        event(new PdfRequest($filename, $route));

        $response = response()
            ->make(file_get_contents(base_path() . $filename), 200,
                [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="'. $route .'.pdf"'
                ]);

        unlink(base_path(). $filename);

        return $response;
    }
}
