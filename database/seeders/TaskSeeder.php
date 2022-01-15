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
        $faker = \Faker\Factory::create();
        for($i = 0; $i < 25; $i++){
            Task::create(
                [
                    'title' => $faker->words($nb = 3, $asText = true),
                    'comment' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    'date' => Carbon::today()->subDays(rand(0, 60)),
                    'time_spent' => rand(5, 180),
                    'user_id' => 1,
                ]
            );
        }
    }
}
