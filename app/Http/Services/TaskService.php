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
            return redirect()->back()->withErrors(['msg' => "Something went wrong"]);;
        }
        return redirect()->route('tasks.index')->with('successMsg', 'Item was created successfully');
    }

}
