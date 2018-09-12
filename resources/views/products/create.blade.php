@extends('layout')

@section('content')

<form method='POST' action='/products' enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="category_id">Category</label>
    <select class="form-control" name="category_id">
      @foreach( $categories as $category)
      <option value="{{$category->id}}">{{$category->name}}</option>
      @endforeach
    </select>
  </div>

  <div class="form-group">
      <label for="body">Name: </label>
      <input type="text" name="name" class="form-control" placeholder="Enter Name">
  </div>
  <div class="form-group">
      <label for="body">Price: </label>
      <input type="number" min="1" step="any" class="form-control" name="price" />
  </div>
  <div class="form-group">
      <label>Description: </label>
      <textarea class="form-control" name="description"></textarea>
  </div>
  <div class="form-group">
    <label>Attach Image: </label>
    <input type="file" name="image">
  </div>
  <a href="/products" class="btn btn-warning">Back</a>
  <button type="submit" class="btn btn-primary">Submit</button>
  
</form>

@endsection