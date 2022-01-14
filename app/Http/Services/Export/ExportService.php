<?php

namespace App\Http\Services\Export;

use App\Http\Factories\Export\CsvExporter;
use App\Http\Factories\Export\PdfExporter;
use App\Http\Factories\Export\XlsExporter;
use App\Models\Task;

class ExportService
{
    public function __construct($format)
    {
        $this->setFormat($format);
    }

    public function export($dateFrom, $dateTo)
    {

        $tasks = Task::when($dateFrom, function ($query) use ($dateFrom) {
            return $query->where('date', '>=', $dateFrom);
        })->when($dateTo, function ($query) use ($dateTo) {
                return $query->where('date', '<', $dateTo);
        })->select('title', 'comment', 'date', 'time_spent')->get();

        $timeSpent = array_sum($tasks->pluck('time_spent')->toArray());

        return $this->ExecuteExportation($tasks, $timeSpent);
    }

    private function ExecuteExportation($tasks, $timeSpent)
    {
        $exporter = $this->getExporter();
        $exporter->setTasks($tasks);
        $exporter->setTotalTime($timeSpent);
        $exporter->setFileName("TrackerHistory");
        return $exporter->exportFile();
    }

    private function getExporter()
    {
        switch ($this->format) {
            case 'pdf':
                return new PdfExporter();
                break;
            case 'csv':
                return new CsvExporter();
                break;
            case 'xls':
                return new XlsExporter();
                break;
        }
    }

    public function setFormat($format)
    {
        $this->format = $format;
    }

}
