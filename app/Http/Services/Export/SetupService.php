<?php

namespace App\Http\Services\Export;
use App\Http\Factories\Export\CsvExporter;
use App\Http\Factories\Export\Exporter;
use App\Http\Factories\Export\PdfExporter;
use App\Http\Factories\Export\XlsExporter;
use App\Interfaces\Exportation\SetupInterface;

class SetupService implements SetupInterface
{

    public function ExecuteExportation($tasks, $timeSpent, $format) : object
    {
        $exporter = $this->getExporter($format);
        $exporter->setTasks($tasks);
        $exporter->setTotalTime($timeSpent);
        $exporter->setFileName(config('task.export_name'));
        return $exporter->exportFile();
    }

    private function getExporter($format) : Exporter
    {
        switch ($format) {
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
