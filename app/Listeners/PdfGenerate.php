<?php

namespace App\Listeners;

use App\Events\PdfRequest;
use PDF;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PdfGenerate
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PdfRequest  $event
     * @return void
     */
    public function handle(PdfRequest $event)
    {
        PDF::loadHTML('<h1>'. $event->getRoute() .'</h1>')
            ->save(base_path() . $event->getFilename());
    }
}
