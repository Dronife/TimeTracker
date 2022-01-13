@extends('layouts.app')
@section('content')

    <div class="container w-50">
        @include('layouts.errorMessage')
        <form action="{{route('tasks.update',$task)}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Title</label>
                <input type="text" maxlength="255" name="title" value="{{$task->title}}" class="form-control bg-white" required>
            </div>
            <div class="form-group mt-2">
                <label for="exampleInputEmail1">Comment</label>
                <textarea maxlength="500" name="comment"  class="form-control bg-white" rows="4" required>{{$task->comment}}</textarea>
            </div>
            <div class="form-group mt-2">
                <label for="exampleInputEmail1">Date</label>
                <input type="date" maxlength="255" name="date" value="{{$task->date}}" class="form-control bg-white" required>
            </div>
            <div class="form-group mt-2">
                <label for="exampleInputEmail1">Duration in minutes</label>
                <input name="time_spent" type="number"  value="{{$task->time_spent}}" min="1" class="form-control bg-white" required>
            </div>
            <button class="btn btn-success mt-5" type="submit">Submit</button>
        </form>
    </div>
@endsection
