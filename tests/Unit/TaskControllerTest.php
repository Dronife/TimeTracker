<?php

namespace Tests\Unit;

use App\Http\Controllers\TaskController;
use App\Http\Requests\TaskRequest;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class TaskControllerTest extends TestCase
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
    public function test_taskRequest_when_all_attributes_correct()
    {
      $taskArray =  [
            'title' => 'task1',
            'comment' => 'comment',
            'date' => Carbon::now()->format('Y-m-d'),
            'time_spent' => 120,
      ];
      $response = $this->actingAs($this->user)
      ->json('POST', route('tasks.store'), $taskArray);
      $response->assertStatus(302);
    }
    public function test_taskRequest_fails_when_one_attribute_is_missed()
    {
      $taskArray =  [
            'title' => 'task1',
            'comment' => 'comment',
            'date' => Carbon::now()->format('Y-m-d'),
      ];
      $response = $this->actingAs($this->user)
      ->json('POST', route('tasks.store'), $taskArray);
      $response->assertStatus(422);
    }
    public function test_taskRequest_fails_when_time_spent_incorrect_in_value()
    {
      $taskArray =  [
            'title' => 'task1',
            'comment' => 'comment',
            'date' => Carbon::now()->format('Y-m-d'),
            'time_spent' => "120a",
      ];
      $response = $this->actingAs($this->user)
      ->json('POST', route('tasks.store'), $taskArray);
      $response->assertStatus(422);
    }
    public function test_taskRequest_fails_when_wrong_date_format()
    {
      $taskArray =  [
            'title' => 'task1',
            'comment' => 'comment',
            'date' => Carbon::now(),
            'time_spent' => 120,
      ];
      $response = $this->actingAs($this->user)
      ->json('POST', route('tasks.store'), $taskArray);
      $response->assertStatus(422);
    }

}
