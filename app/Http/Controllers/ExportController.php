<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExportRequest;
use App\Http\Services\Export\ExportService ;
use Illuminate\Http\Request;

class ExportController extends Controller
{


    public function handle(ExportRequest $request){
       
        $exportService = new ExportService($request->format);
        return $exportService->export($request->from, $request->to);
    }
}
