<?php

namespace Tests\Unit;

use App\Http\Services\Export\ExportService;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExportServiceTest extends TestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
        
    }

    public function test_download_file()
    {
        Storage::fake('local');
        $format = 'csv';
        $exportService = new ExportService( $format);
        $response = $exportService->export( null,  null);
        $this->assertEquals($response->getStatusCode(), 200);
        $this->unlinkFiles($response->headers->get('content-disposition'));       
    }
    public function test_downloaded_file_is_csv()
    {
        
        $format = 'csv';
        $exportService = new ExportService( $format);
        $response = $exportService->export( null,  null);
        $this->assertEquals($format, \File::extension($response->headers->get('content-disposition')));
        $this->unlinkFiles($response->headers->get('content-disposition'));    
    }
    public function test_downloaded_file_is_xls()
    {
        
        $format = 'xls';
        $exportService = new ExportService( $format);
        $response = $exportService->export( null,  null);
        $this->assertEquals($format, \File::extension($response->headers->get('content-disposition')));
        $this->unlinkFiles($response->headers->get('content-disposition'));    
    }

    public function test_downloaded_file_is_pdf()
    {
        $format = 'pdf';
        $exportService = new ExportService( $format);
        $response = $exportService->export( null,  null);
        $this->assertEquals($format, \File::extension($response->headers->get('content-disposition')));
        $this->unlinkFiles($response->headers->get('content-disposition'));    
    }
    public function test_downloaded_file_default_is_pdf()
    {
        $format = 'zxc';
        $exportService = new ExportService( $format);
        $response = $exportService->export( null,  null);
        $this->assertEquals('pdf', \File::extension($response->headers->get('content-disposition')));
        $this->unlinkFiles($response->headers->get('content-disposition'));    
    }

    private function unlinkFiles($string){
        preg_match_all("/\w+\.\w+/", $string, $output);
        unlink($output[0][0]);
    }
}
