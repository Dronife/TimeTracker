@extends('layouts.app')
@section('content')

    <div class="container w-50">
       
            @include('layouts.successMessage')
        <form action="/tasks" method="post">
            @csrf
            <div class="form-group">
                <label>Title</label>
                <input type="text" maxlength="255" name="title" value="{{old('title')}}" class="form-control bg-white" required>
            </div>
            <div class="form-group mt-2">
                <label for="exampleInputEmail1">Comment</label>
                <textarea maxlength="500" name="comment"  class="form-control bg-white" rows="4" required>{{old('comment')}}</textarea>
            </div>
            <div class="form-group mt-2">
                <label for="exampleInputEmail1">Date</label>
                <input type="date" maxlength="255" name="date" value="{{old('date')}}" class="form-control bg-white" required>
            </div>
            <div class="form-group mt-2">
                <label for="exampleInputEmail1">Duration in minutes</label>
                <input name="time_spent" type="number"  value="{{old('time_spent')}}" min="1" class="form-control bg-white" required>
            </div>
            <button class="btn btn-success mt-5" type="submit">Submit</button>
        </form>
    </div>
@endsection
