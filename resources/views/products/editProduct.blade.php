@extends('layout')

@section('content')
<div class="container">
<form method='POST' action='/products/{{ $product_id }}' enctype="multipart/form-data">
  {{ csrf_field() }}
  {{ method_field('PATCH') }}
  <div class="form-group">
    <label for="category_id">Category</label>
    <select class="form-control" name="category_id">
      @foreach( $categories as $category)
      <option value="{{$category->id}}" @if( $category->id == $product->category_id ){{"selected"}}@endif>
      {{$category->name}}
      </option>
      @endforeach
    </select>
  </div>

  <div class="form-group">
      <label for="body">Name: </label>
      <input type="text" name="name" class="form-control" value="{{ $product->name }}">
  </div>
  <div class="form-group">
      <label for="body">Price: </label>
      <input type="number" min="1" step="any" class="form-control" name="price" value="{{ $product->price }}">
  </div>
  <div class="form-group">
      <label>Description: </label>
      <textarea class="form-control" name="description">{{ $product->description }}</textarea>
  </div>
  <div class="form-group">
    <label>Attach Image: </label>
    <input type="file" name="image">
  </div>
  <a href="/products" class="btn btn-warning">Back</a>
  <button type="submit" class="btn btn-primary">Submit</button>
  
</form>
</div>
@endsection