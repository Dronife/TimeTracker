<?php

namespace Tests\Unit;

use App\Http\Services\TaskService;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class TaskServiceTest extends TestCase
{
    use RefreshDatabase;


    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->taskService = new TaskService();
        
    }

    // private function createTask(){
    //     return 
    //  }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_fails_without_one_of_attribute_on_store()
    {
        $this->actingAs($this->user);
          $taskArray =  [
                'title' => 'task1',
                'comment' => 'comment',
                'date' => Carbon::now(),
                'user_id' => 2,
          ];
        $response = $this->taskService->store($taskArray);
        $this->assertFalse($response);
    }

    public function test_not_auth_user_fails_on_store()
    {
          $taskArray =  [
                'title' => 'task1',
                'comment' => 'comment',
                'date' => Carbon::now(),
                'time_spent' => 120,

          ];
        $response = $this->taskService->store($taskArray);
        $this->assertFalse($response);
    }

    public function test_task_will_be_asigned_only_to_auth_user_id_on_store()
    {
        $this->actingAs($this->user);
          $taskArray =  [
                'title' => 'task1',
                'comment' => 'comment',
                'date' => Carbon::now(),
                'time_spent' => 120,
                'user_id' => 2000,
          ];
        $this->taskService->store($taskArray);
        $this->assertEquals($this->user->id, Task::first()->user_id);
    }

}
