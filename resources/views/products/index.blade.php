@extends('layout')

@section('content')
<div class="container">
<div class="form-group">
  <a href="/products/create" class="btn btn-primary btn-sm">Add Product</a>
</div>
@foreach( $products as $product )
<div class="card rounded" style="padding: 10px">
  <div class="card-header">
    {{ $product->name }}
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-4">
        <img src="/images/{{ $product->image }}" alt="{{ $product->name }} image" class="img-fluid img-thumbnail">
      </div>
      <div class="col-md-8">
        <div class="row">
          <div class="col-md-8">
            <strong>Details</strong><br><hr>
            <p class="text-primary">Product Price: KES {{ $product->price }}</p>
            <p class="text-primary">
            Product Status:
            @if( $product->status == 1)
            {{ "Available" }}
            @else
            {{ "Not Available" }}
            @endif
            </p>
            <p class="text-primary">Product Description: {{ $product->description }}</p>
          </div>
          <div class="col-md-4">
            <strong>Features</strong><br><hr>
            @foreach( $product->features as $value)
              @foreach( Auth::user()->features as $feature)
                @if( $value->parent == $feature->id )
                {{ $feature->name }}: 
                @endif
              @endforeach
                {{ $value->name }}<br/>
            @endforeach
          </div>
        </div>
      </div>
      <div class="card-footer">
              <form action="/products/{{ $product->id }}" method="POST">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <a href="/products/{{ $product->id }}" class="btn btn-primary btn-sm">View</a>
              <a href="/product_features/{{ $product->id }}" class="btn btn-info btn-sm">Features</a>
              <a href="/product_features/create/{{ $product->id }}" class="btn btn-warning btn-sm">Add Feature</a>
              <button class="btn btn-danger btn-sm" type="submit">Delete</button>
              </form>
      </div>
    </div>
  </div>
</div>
<br><br>
@endforeach

@endsection