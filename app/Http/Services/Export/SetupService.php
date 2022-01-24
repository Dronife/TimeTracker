<?php

namespace App\Http\Services\Export;
use App\Http\Factories\Export\CsvExporter;
use App\Http\Factories\Export\Exporter;
use App\Http\Factories\Export\PdfExporter;
use App\Http\Factories\Export\XlsExporter;

class SetupService
{

    public function ExecuteExportation($tasks, $timeSpent) : object
    {
        $exporter = $this->getExporter();
        $exporter->setTasks($tasks);
        $exporter->setTotalTime($timeSpent);
        $exporter->setFileName(config('task.export_name'));
        return $exporter->exportFile();
    }

    private function getExporter() : Exporter
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
            default:
                return new PdfExporter();
            break;

        }
    }
}
