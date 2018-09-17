@extends('layout')

@section('content')
<div class="container">
  <label>Feature: </label>
  <select name="parent" id="featureName" class="form-control" onchange="showFeatureDiv( '{{ json_encode($features) }}' )">
    <option value="" selected>-- Select Feature Name--</option>
    @foreach($features as $parent)
    @if( $parent->parent == 0)
    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
    @endif
    @endforeach
  </select>
  <div id="featureForm" style="display: none">
    <form action="/product_features" method="POST">
      {{ csrf_field() }}
      <input type="hidden" value="{{ $product->id }}" name="product_id">
      <div class="form-group">
        <label for="featureValue">Feature Value: </label>
        <select name="feature_id" id="featureValue" class="form-control">
          <option value="" selected>-- Select Feature Value--</option>
        </select>
      </div>
      <div class="form-group">
        <a href="/products/{{ $product->id }}" class="btn btn-warning btn-sm">Back</a>
        <button class="btn btn-primary btn-sm" type="submit">Submit</button>
      </div>
    </form>
  </div>
</div>
@endsection