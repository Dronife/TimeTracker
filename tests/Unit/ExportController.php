<?php

namespace Tests\Unit;


use App\Http\Requests\TaskRequest;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class ExportController extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_exportRequest_fails_when_dateTo_is_smaller_than_dateFrom()
    {
      $exportArray=  [
            'format' => 'pdf',
            'from' => '2021-12-31',
            'to' => '2021-12-01'
      ];
      $response = $this->actingAs($this->user)
      ->json('POST', '/export', $exportArray);
      $response->assertStatus(422);
    }
    
    public function test_exportRequest_fails_when_no_format()
    {
      $exportArray=  [
            'from' => '2021-12-31',
            'to' => '2021-12-01'
      ];
      $response = $this->actingAs($this->user)
      ->json('POST', '/export', $exportArray);
      $response->assertStatus(422);
    }
}
