<?php

namespace App\Http\Services\Export;

use App\Http\Services\Export\ExportationStrategy;
use App\Models\Task;

class ExportService
{
    public function __construct( $strategy)
    {
        $this->strategy = null;
        switch($strategy){
            case 'pdf':
                $this->strategy = new PdfExportation;
                break;
        }
    }

    public function export($dateFrom, $dateTo){

        $tasks = Task::when($dateFrom, function($query) use($dateFrom){
            return $query->where('date', '>=', $dateFrom);
        })
        ->when($dateTo, function($query) use($dateTo){
            return $query->where('date', '<', $dateTo);
        })->get();
        // dd($tasks);

        $this->strategy->export($tasks);
    }

}
