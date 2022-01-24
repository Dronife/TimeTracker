<?php

namespace App\Http\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskService
{

    public function store($attributes)
    {
        try {
            Auth::user()->tasks()->create($attributes);
        } catch (\Throwable $e) {

            return false;
        }
        return true;
    }

    public function destroy($id)
    {
        $user = Auth::user();

        try {
            $task = $user->tasks()->find($id);
            if ($task->user_id != $user->id) {

                return false;
            }
            $task->delete();
        } catch (\Throwable $e) {

            return false;
        }
        return true;
    }

    public function edit($task_user_id)
    {
        return $task_user_id == Auth::user()->id;
    }

    public function update($attributes, $id)
    {

        $user = Auth::user();


        try {
            $task = $user->tasks()->find($id);
            if ($task->user_id != $user->id) {

                return false;
            }
            $task->update($attributes);
        } catch (\Throwable $e) {

            return false;
        }
        return true;
    }
}
