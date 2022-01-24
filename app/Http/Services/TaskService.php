<?php

namespace App\Http\Services;

use App\Interfaces\TaskInterface;
use Illuminate\Support\Facades\Auth;

class TaskService implements TaskInterface
{

    public function store($attributes): bool
    {
        try {
            Auth::user()->tasks()->create($attributes);
        } catch (\Throwable $e) {
            return false;
        }
        return true;
    }

    public function destroy($id) : bool
    {
        try {
            Auth::user()->tasks()->find($id)->delete();
        } catch (\Throwable $e) {
            return false;
        }
        return true;
    }

    public function edit($task_user_id) : bool
    {
        return $task_user_id == Auth::user()->id;
    }

    public function update($attributes, $id) : bool
    {
        try {
            Auth::user()->tasks()->find($id)->update($attributes);
        } catch (\Throwable $e) {
            return false;
        }
        return true;
    }
}
