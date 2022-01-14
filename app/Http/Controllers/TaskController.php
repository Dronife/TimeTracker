<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Services\TaskService;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->taskService = new TaskService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Auth::user()->tasks()->paginate(10);
        return view('task.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        if($this->taskService->store($request->validated()))
            return redirect()->route('tasks.index')->with('successMsg', 'Item was created successfully');
        return redirect()->back()->withErrors(['msg' => "Something went wrong"]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        
        if($this->taskService->edit($task->user_id))
            return view('task.edit', ['task' => $task]);
        return redirect()->route('tasks.index')->withErrors(['msg' => "Do not have rights to edit"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id)
    {
        if($this->taskService->update($request->validated(),$id))
            return redirect()->route('tasks.index')->with('successMsg', 'Item was updated successfully');
        return redirect()->back()->withErrors(['msg' => "Something went wrong"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->taskService->destroy($id))
            return redirect()->route('tasks.index')->with('successMsg', 'Item was deleted successfully');
        return redirect()->route('tasks.index')->withErrors(['msg' => "Something went wrong"]);

    }
}
