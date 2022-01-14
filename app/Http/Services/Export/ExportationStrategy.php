<?php

namespace App\Http\Services\Export;

interface ExportationStrategy
{
    public function export(array $data);
}
