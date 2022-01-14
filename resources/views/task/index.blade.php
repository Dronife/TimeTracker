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
                        <th style="width: 20%;">Title</th>
                        <th style="width: 50%;">Comment</th>
                        <th>Date</th>
                        <th>Duration(mins)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->comment }}</td>
                            <td>{{ $task->date }}</td>
                            <td>{{ $task->time_spent }}</td>
                            <td>
                                <div class="d-flex">
                                    <div class="mx-1 mt-1">
                                        @include('layouts.deleteButton',['action' => route('tasks.destroy', $task)])
                                    </div>
                                    <div class="mx-1 mt-1">
                                        <a href="{{ route('tasks.edit', $task) }}" class="fa fa-pen text-dark"></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="container">
                <div class="row px-5">
                    <div class="col-3 ml-auto border-right">
                        {{ $tasks->links() }}
                    </div>
                    <div class="col mr-auto">
                        @include('layouts.export.selection')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
