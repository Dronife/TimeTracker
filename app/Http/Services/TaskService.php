<?php

namespace App\Http\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskService
{

    public function store($attributes)
    {
        DB::beginTransaction();
        try {
            Auth::user()->tasks()->create($attributes);
            DB::commit();
        } catch (\Throwable$e) {
            DB::rollBack();
            return false;
        }
        return true;
    }

    public function destroy($id)
    {
        $user = Auth::user();

        DB::beginTransaction();
        try {
            $task = $user->tasks()->find($id);
            if($task->user_id != $user->id){
                DB::rollBack();
                return false;
            }
            $task->delete();
            DB::commit();
        } catch (\Throwable$e) {
            DB::rollBack();
            return false;
        }
        return true;
    }

    public function edit($task_user_id){
        return $task_user_id == Auth::user()->id;
    }

    public function update($attributes, $id){

        $user = Auth::user();

        DB::beginTransaction();
        try {
            $task = $user->tasks()->find($id);
            if($task->user_id != $user->id){
                DB::rollBack();
                return false;
            }
            $task->update($attributes);
            DB::commit();
        } catch (\Throwable$e) {
            DB::rollBack();
            return false;
        }
        return true;
    }

}
