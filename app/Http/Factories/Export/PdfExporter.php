<?php

namespace App\Http\Factories\Export;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfExporter extends Exporter
{
    public function exportFile(){
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);
        $htmlData = view('exportation.pdfIndex', ['tasks' => $this->tasks, 'totalTime' => $this->totalTime]);
        $dompdf->loadHtml($htmlData, 'UTF-8');
        // $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents($this->fileName.".pdf", $output);
        return response()->download($this->fileName.".pdf")->deleteFileAfterSend(true);

    }
}
