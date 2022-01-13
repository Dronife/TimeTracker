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
        } catch (\Throwable $e) {
            DB::rollBack();
            return false;
        }
        return true;
    }

    public function destroy($id){
        DB::beginTransaction();
        try {
            Auth::user()->tasks()->find($id)->delete();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return false;
        }
        return true;
    }

}
