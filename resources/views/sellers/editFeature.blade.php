@extends('layout')

@section('content')

<form method='POST' action='/features/{{ $feature->id }}'>
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    <div class="form-group">
        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
        <label for="parent">Parent</label>
    <select class="form-control" name ="parent" id="parent">
            <option vlaue="0">--No Parent--</option>
            @foreach($features as $feat)
            <option value="{{$feat->id}}" @if( $feat->id == $feature->parent){{"selected"}}@endif >
            {{ $feat->name }}
            </option>
            @endforeach
           
        </select>
    </div>

    <div class="form-group">
        <label for="body">Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{$feature->name}}">
    </div>
    <a href="/features" class="btn btn-warning">Back</a>
    <button type="submit" class="btn btn-primary">Submit</button>
    
    </form>

@endsection