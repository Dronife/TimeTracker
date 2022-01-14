<?php

namespace App\Http\Factories\Export;

abstract class Exporter
{
    public function __construct()
    {

        $this->setColumns(config('task.columns'));
    }

    abstract public function exportFile();

    public function setTotalTime($totalTime){
        $this->totalTime = $totalTime;
    }

    public function setTasks($tasks){
        $this->tasks = $tasks;
    }

    public function setColumns($columns){
        $this->columns = $columns;
    }

    public function setFileName($fileName){
        $this->fileName = $fileName;
    }

    public function composeSpaceForTotalTimeSpent(){
        $lastLine = [];
        for($i = 0; $i < count($this->columns)-2; $i++)
            $lastLine [] = '';
        $lastLine [] = "Total time spent";
        $lastLine [] = $this->totalTime;
        return $lastLine;
    }
}
