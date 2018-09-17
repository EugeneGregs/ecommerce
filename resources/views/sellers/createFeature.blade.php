@extends('layout')

@section('content')
<div class="container">
<form method='POST' action='/features'>
    {{ csrf_field() }}
    <div class="form-group">
        <label for="parent">Parent</label>
        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
        <select class="form-control" name="parent">
            <option value="0">--No Parent--</option>
            @if(count( $features ))
                @foreach( $features as $feature)
                <option value="{{$feature->id}}">{{$feature->name}}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="form-group">
        <label for="body">Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter Name">
    </div>
    <a href="/features" class="btn btn-warning">Back</a>
    <button type="submit" class="btn btn-primary">Submit</button>
    
    </form>
    </div>
@endsection