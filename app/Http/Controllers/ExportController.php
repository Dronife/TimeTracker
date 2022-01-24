<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExportRequest;
use App\Http\Services\Export\ExportService ;
use Illuminate\Http\Request;

class ExportController extends Controller
{

    public function __construct(ExportService $exportService)
    {
        $this->$exportService = $exportService;
    }


    public function handle(ExportRequest $request){
       
        $this->$exportService->setFormat($request->format);
        return $this->$exportService->export($request->from, $request->to);
    }
}
