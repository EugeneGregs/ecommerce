@extends('layout')
@section('content')
<div class="container">
<div class="card">
   <div class="card-body">
      <h5 class="card-title">{{ $product->name }} Features</h5>
      @foreach($product->features as $feature)
      <div class="row">
        <div class="col-md-4">
          <p class="text-primary">
            @foreach($features as $parent)
            @if($feature->parent == $parent->id)
            {{ $parent->name}}:
            @endif
            @endforeach
            {{ $feature->name }}
          </p>
        </div>
        <div class="col-md-2">
          <a href="/product_features/{{ $product->id }}/{{ $feature->id }}" class="btn btn-danger btn-sm"
                onclick="event.preventDefault();
                document.getElementById('delete-form').submit();">
            Delete </a>
            <a href="/product_features/{{ $product->id }}/{{ $feature->id }}" class="btn btn-info btn-sm">
            Edit </a>
        </div>
      </div>
      <form id="delete-form" action="/product_features/{{ $product->id }}/{{ $feature->id }}" method="POST" style="display: none;">
         @csrf
         {{ method_field('DELETE') }}
      </form>
      @endforeach
      <a href="/products/{{ $product->id }}" class="card-link btn btn-warning btn-sm">Back</a>
      <a href="/product_features/create/{{ $product->id }}" class="card-link btn btn-warning btn-sm">Add Feature</a>
   </div>
</div>
</div>
@endsection