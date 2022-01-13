<?php

namespace Database\Seeders;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::create(
            [
                'title' => 'task1',
                'comment' => 'comment',
                'date' => Carbon::now(),
                'time_spent' => 120,
                'user_id' => 1,
            ]
        );
    }
}
