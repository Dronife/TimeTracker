@extends('layouts.app')
@section('content')
<div class="container">
       @include('layouts.successMessage')
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
                        <a class="fa fa-trash text-danger"></a>
                        <a class="fa fa-pen text-dark"></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection