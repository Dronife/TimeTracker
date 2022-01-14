<?php

namespace App\Http\Factories\Export;

abstract class Exporter
{

    abstract public function exportFile();

    public function setTotalTime($totalTime){
        $this->totalTime = $totalTime;
    }

    public function setTasks($tasks){
        $this->tasks = $tasks;
    }
}
