<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class TaskTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        
    }

    private function createTask(){
       return Task::create(
            [
                'title' => 'task1',
                'comment' => 'comment',
                'date' => Carbon::now(),
                'time_spent' => 120,
                'user_id' => $this->user->id,
            ]
        );
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_task_created_successfully()
    {
        $task = $this->createTask(); 
        $this->assertNotNull($task);
    }

    public function test_task_belongs_to_user(){
        $task = $this->createTask();
        $this->assertEquals($task->user->id, $this->user->id);
    }
}
