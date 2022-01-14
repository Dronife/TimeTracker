<?php

namespace App\Http\Services;

use App\Http\Services\Export\ExportationStrategy;
use App\Models\Task;

class ExportService
{
    public function __construct(ExportationStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function export($dateFrom, $dateTo){

        $tasks = Task::top(10);
        $result = $this->strategy->export($tasks);
    }

}
