@extends('layout')

@section('content')

<form method='POST' action='/categories/{{ $category->id }}'>
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    <div class="form-group">
        <label for="parent">Parent</label>
    <select class="form-control" name ="parent" id="parent">
            @foreach($categories as $cat)
            <option value="{{$cat->id}}" @if( $cat->id == $category->parent){{"selected"}}@endif >
            {{ $cat->name }}
            </option>
            @endforeach
           
        </select>
    </div>

    <div class="form-group">
        <label for="body">Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{$category->name}}">
    </div>
    <a href="/categories" class="btn btn-warning">Back</a>
    <button type="submit" class="btn btn-primary">Submit</button>
    
    </form>

@endsection