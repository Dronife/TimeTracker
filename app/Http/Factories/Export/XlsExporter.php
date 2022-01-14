<?php

namespace App\Http\Factories\Export;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
class XlsExporter extends Exporter
{
    public function exportFile()
    {

        $filename = $this->fileName . '.xls';
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->fromArray(
            $this->mergeArray(),  
            NULL,        
            'A1'                  
        );;
        $writer = new Xls($spreadsheet);
        $writer->save($filename);
        header('Content-type: text/xls');
        header('Content-disposition:attachment; filename="'.$filename.'"'); 
        readfile($filename);
        unlink($filename);
    }

    private function mergeArray(){
        $array = [$this->columns];
        foreach($this->tasks->toArray() as $task)
            $array[] = $task;
        $array[] = $this->composeSpaceForTotalTimeSpent();
        return $array;
    }
}
