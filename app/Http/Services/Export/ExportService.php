<?php

namespace App\Http\Services\Export;

use App\Http\Factories\Export\Exporter;
use App\Http\Factories\Export\PdfExporter;
use App\Http\Services\Export\ExportationStrategy;
use App\Models\Task;

class ExportService
{
    public function __construct( $format)
    {
       $this->setFormat($format);
    }

    public function export($dateFrom, $dateTo){

        $tasks = Task::when($dateFrom, function($query) use($dateFrom){
            return $query->where('date', '>=', $dateFrom);
        })
        ->when($dateTo, function($query) use($dateTo){
            return $query->where('date', '<', $dateTo);
        })->get();

        $timeSpent = array_sum($tasks->pluck('time_spent')->toArray());

        return $this->ExecuteExportation($tasks, $timeSpent);
    }

    private function ExecuteExportation($tasks, $timeSpent){
        $exporter = $this->getExporter();        
        $exporter->setTasks($tasks);
        $exporter->setTotalTime($timeSpent);
        return $exporter->exportFile();
    }

    private function getExporter(){
        switch($this->format){
            case 'pdf':
               return new PdfExporter();
            break;
        }
    }

    public function setFormat($format){
        $this->format = $format;
    }

}
