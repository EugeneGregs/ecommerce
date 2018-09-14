@extends('layout')

@section('content')
<div>
  <label>Feature: </label>
  <select name="parent" id="featureName" class="form-control" onchange="showFeatureDiv( '{{ json_encode($features) }}' )">
    <option value="" selected>-- Select Feature Name--</option>
    @foreach($features as $parent)
    @if( $parent->parent == 0)
    <option value="{{ $parent->id }}" @if($feature->parent == $parent->id){{"selected"}}@endif>{{ $parent->name }}</option>
    @endif
    @endforeach
  </select>
  <div id="featureForm" style="display: block">
    <form action="/product_features/{{ $feature->id }}" method="POST">
      {{ csrf_field() }}
      {{ method_field('PATCH') }}
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