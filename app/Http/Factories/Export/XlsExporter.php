<?php

namespace App\Http\Factories\Export;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
class XlsExporter extends Exporter
{
    public function exportFile()
    {

        // dd($this->mergeArray());
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->fromArray(
            $this->mergeArray(),  
            NULL,        
            'A1'                  
        );;
        $writer = new Xls($spreadsheet);
        $writer->save('hello world.xls');
        header('Content-type: text/csv');
        header('Content-disposition:attachment; filename="hello world.xls"'); 
        readfile('hello world.xls');
    }

    private function mergeArray(){
        $array = [$this->columns];
        foreach($this->tasks->toArray() as $task)
            $array[] = $task;
        $array[] = $this->composeSpaceForTotalTimeSpent();
        return $array;
    }
}
