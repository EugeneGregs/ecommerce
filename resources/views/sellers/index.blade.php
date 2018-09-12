@extends('layout')

@section('content')
<div class="container">
  <div class="alert alert-info">
    Welcome {{ Auth::user()->user_type->user_type }} {{ Auth::user()->name }}
  </div>
</div>
@endsection