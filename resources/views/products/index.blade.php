@extends('layout')

@section('content')
<div class="form-group">
<a href="/products/create" class="btn btn-primary btn-lg">Add Product</a>
</div>
@foreach( $products as $product )
<div class="row">
  <div class="col-md-4">
    <img src="/storage/images/{{ $product->image }}" alt="{{ $product->name }} image" style="width:100%">
  </div>
  <div class="col-md-8">
    <strong>Details</strong><br><hr>
    <p class="text-primary">Product Name: {{ $product->name }}</p>
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
    <hr>
    <strong>Features</strong><br><hr>
    <form action="/products/{{ $product->id }}" method="POST">
     {{ csrf_field() }}
     {{ method_field('DELETE') }}
     <a href="/products/{{ $product->id }}" class="btn btn-primary btn-sm">View</a>
    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
    </form>
  </div>
</div>
@endforeach

@endsection