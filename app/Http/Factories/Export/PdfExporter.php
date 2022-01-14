<?php

namespace App\Http\Factories\Export;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfExporter extends Exporter
{
    public function exportFile(){
        dd($this->totalTime);
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);
        $htmlData = view('exportation.pdfIndex', ['tasks' => $this->tasks, 'timeSpent' => $this->totalTime]);
        $dompdf->loadHtml($htmlData, 'UTF-8');
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream();
    }
}
