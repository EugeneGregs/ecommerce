@extends('layout')

@section('content')
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
    <strong>Features</strong><hr><br><br><br>
    <form action="/products/{{ $product->id }}" method="POST">
     {{ csrf_field() }}
     {{ method_field('DELETE') }}
     <a href="/products" class="btn btn-warning btn-sm">Back</a>
    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
    </form>
  </div>
</div>
@endsection