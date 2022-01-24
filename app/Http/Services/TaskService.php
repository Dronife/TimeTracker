<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;

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
        try {
            Auth::user()->tasks()->find($id)->delete();
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
        try {
            Auth::user()->tasks()->find($id)->update($attributes);
        } catch (\Throwable $e) {
            return false;
        }
        return true;
    }
}
