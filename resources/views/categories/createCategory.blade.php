@extends('layout')

@section('content')
<div class="container">
<form method='POST' action='/categories'>
    {{ csrf_field() }}
    <div class="form-group">
        <label for="parent">Parent</label>
        <select class="form-control" name="parent">
            <option value="0">--No Parent--</option>
            @if(count( $categories ))
                @foreach( $categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="form-group">
        <label for="body">Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter Name">
    </div>
    <a href="/categories" class="btn btn-warning">Back</a>
    <button type="submit" class="btn btn-primary">Submit</button>
    
    </form>
</div>
@endsection