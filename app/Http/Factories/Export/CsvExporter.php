<?php

namespace App\Http\Factories\Export;

class CsvExporter extends Exporter
{
    public function exportFile()
    {
        $filename = $this->fileName . '.csv';
        $fp = fopen($filename, 'w');
        fputcsv($fp, $this->columns);
        foreach ($this->tasks as $task) {
            fputcsv($fp, $task->toArray());
        }
        fputcsv($fp, $this->composeSpaceForTotalTimeSpent());
        fclose($fp);
        header('Content-type: text/csv');
        header('Content-disposition:attachment; filename="' . $filename . '"');
        readfile($filename);
        unlink($filename);
    }

   
}
