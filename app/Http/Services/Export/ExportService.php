<?php

namespace App\Http\Services\Export;


use App\Models\Task;

class ExportService
{
    public function __construct($format)
    {
        $this->setFormat($format);
    }

    public function export($dateFrom, $dateTo) : object
    {
        $tasks = Task::getTasks($dateFrom, $dateTo)->get();
        $timeSpent = array_sum($tasks->pluck('time_spent')->toArray());

        return (new SetupService())->ExecuteExportation($tasks, $timeSpent);
    }

    public function setFormat($format) : void
    {
        $this->format = $format;
    }

}
