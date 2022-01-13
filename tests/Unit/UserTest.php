<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class UserTest extends TestCase
{

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
    public function test_user_has_one_task()
    {
        Task::create(
            [
                'title' => 'task1',
                'comment' => 'comment',
                'date' => Carbon::now(),
                'time_spent' => 120,
                'user_id' => $this->user->id,
            ]
        );
        $this->assertEquals(1, count($this->user->tasks));

    }
}
