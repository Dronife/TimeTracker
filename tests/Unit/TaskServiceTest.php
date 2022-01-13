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
          ];
        $this->taskService->store($taskArray);
        $this->assertEquals($this->user->id, Task::first()->user_id);
    }
    public function test_delete_task()
    {
        $this->actingAs($this->user);
          $taskArray =  [
                'title' => 'task1',
                'comment' => 'comment',
                'date' => Carbon::now(),
                'time_spent' => 120,
          ];
        $this->taskService->store($taskArray);
        $response = $this->taskService->destroy(1);
        $this->assertTrue($response);
    }

    public function test_fails_to_delete_when_does_not_exist()
    {
        $this->actingAs($this->user);
          $taskArray =  [
                'title' => 'task1',
                'comment' => 'comment',
                'date' => Carbon::now(),
                'time_spent' => 120,
          ];
        $this->taskService->store($taskArray);
        $response = $this->taskService->destroy(2);
        $this->assertFalse($response);
    }

    public function test_fails_when_other_user_tries_to_delete_task()
    {
        $this->actingAs($this->user);
          $taskArray =  [
                'title' => 'task1',
                'comment' => 'comment',
                'date' => Carbon::now(),
                'time_spent' => 120,
          ];
        $this->taskService->store($taskArray);
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->taskService->destroy(1);
        $this->assertFalse($response);
    }

    public function test_fails_when_other_user_tries_to_edit_task()
    {
        $this->actingAs($this->user);
          $taskArray =  [
                'title' => 'task1',
                'comment' => 'comment',
                'date' => Carbon::now(),
                'time_spent' => 120,
          ];
        $this->taskService->store($taskArray);
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->taskService->edit(1);
        $this->assertFalse($response);
    }

    public function test_owner_can_edit_task()
    {
        $this->actingAs($this->user);
          $taskArray =  [
                'title' => 'task1',
                'comment' => 'comment',
                'date' => Carbon::now(),
                'time_spent' => 120,
          ];
        $this->taskService->store($taskArray);
        $response = $this->taskService->edit(1);
        $this->assertTrue($response);
    }

    public function test_owner_successfully_updated_task()
    {
        $this->actingAs($this->user);
          $taskArray =  [
                'title' => 'task1',
                'comment' => 'comment',
                'date' => Carbon::now(),
                'time_spent' => 120,
          ];
        $this->taskService->store($taskArray);

        $expectedTitle = "testSuccess";
        $updateTaskArray =  [
            'title' => $expectedTitle,
            'comment' => 'comment',
            'date' => Carbon::now(),
            'time_spent' => 120,
         ];

        $this->taskService->update($updateTaskArray,1);
        $this->assertEquals($expectedTitle,Task::find(1)->title);
    }
    public function test_owner_can_update_task()
    {
        $this->actingAs($this->user);
          $taskArray =  [
                'title' => 'task1',
                'comment' => 'comment',
                'date' => Carbon::now(),
                'time_spent' => 120,
          ];
        $this->taskService->store($taskArray);
        $updateTaskArray =  [
            'title' => 'task112',
            'comment' => 'comment',
            'date' => Carbon::now(),
            'time_spent' => 120,
         ];
        $response = $this->taskService->update($updateTaskArray,1);
        $this->assertTrue($response);
    }
    public function test_other_user_cannot_update_task()
    {
        $this->actingAs($this->user);
          $taskArray =  [
                'title' => 'task1',
                'comment' => 'comment',
                'date' => Carbon::now(),
                'time_spent' => 120,
          ];
        $this->taskService->store($taskArray);
        $updateTaskArray =  [
            'title' => 'task112',
            'comment' => 'comment',
            'date' => Carbon::now(),
            'time_spent' => 120,
         ];
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->taskService->update($updateTaskArray,1);
        $this->assertFalse($response);
    }

}
