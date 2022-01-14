<?php

namespace App\Http\Services\Export;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfExportation implements ExportationStrategy
{
    public function export($tasks)
    {
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);
        $htmlData = view('exportation.pdfIndex', ['tasks' => $tasks, 'timeSpent' => 123]);
        $dompdf->loadHtml($htmlData, 'UTF-8');
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
    }
}
