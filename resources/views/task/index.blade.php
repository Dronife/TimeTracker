@extends('layouts.app')
@section('content')
<div class="container">
       @include('layouts.successMessage')
       @include('layouts.errorMessage')
    <a href="/tasks/create" class="btn btn-primary">Create new</a>
    <div class="mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Comment</th>
                    <th>Date</th>
                    <th>Duration(mins)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td>{{$task->title}}</td>
                    <td>{{$task->comment}}</td>
                    <td>{{$task->date}}</td>
                    <td>{{$task->time_spent}}</td>
                    <td>
                        {{-- <a class="text-danger" onclick="return confirm('Are you sure you want to delete?')" href="{{route('tasks.destroy', $task)}}"><i class="fa fa-trash"></i></a> --}}
                        {{-- <a class="fa fa-trash text-danger"></a> --}}
                        @include('layouts.deleteButton',['action' => route('tasks.destroy', $task)])
                        <a href="{{route('tasks.edit', $task)}}" class="fa fa-pen text-dark"></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection