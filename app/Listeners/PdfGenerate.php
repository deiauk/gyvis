<?php

namespace App\Listeners;

use App\Events\PdfRequest;
use PDF;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\AnimalsTable;
use App\Repositories\MedicinesTable;
use App\Repositories\TreatmentsTable;
use App\Repositories\HeatsTable;
use App\Repositories\CalvingTable;

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
        PDF::loadHTML($this->getHTML($event))
            ->setPaper('a4', 'landscape')
            ->save(base_path() . $event->getFilename());
    }
    private function getHTML(PdfRequest $event)
    {
        switch ($event->getRoute()) {
            case "sarasas":
                $obj = new AnimalsTable($event->getDateRange());
                return $obj->getView("pdf.animals", $obj->getData());
                break;
            case "gydymai":
                $obj = new TreatmentsTable($event->getDateRange());
                return $obj->getView("pdf.treatments", $obj->getData());
                break;
            case "medikamentai":
                $obj = new MedicinesTable($event->getId());
                //$obj = new MedicinesTable($event->getCategory(), $event->getDateRange());
                return $obj->getView("pdf.medicines", $obj->getData());
            case "ruja":
                $obj = new HeatsTable($event->getSearch(), $event->getDateRange());
                return $obj->getView("pdf.heats", $obj->getData());
            case "versiavimasis":
                $obj = new CalvingTable($event->getDateRange());
                return $obj->getView("pdf.heats", $obj->getData());

//                switch ($event->getCategory()) {
//                    case 1:
//                        $obj = new MedicinesTable(1, $event->getDateRange());
//                        return $obj->getView("pdf.medicines", $obj->getData());
//                        break;
//                    case 2:
//                        $obj = new MedicinesTable(2, $event->getDateRange());
//                        return $obj->getView("pdf.medicines", $obj->getData());
//                        break;
//                }
                break;
        }
    }
}
