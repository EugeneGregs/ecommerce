@extends('layout')

@section('content')
<div class="container">
  <div class="alert alert-success">
    Welcome {{ Auth::user()->user_type->user_type }} {{ Auth::user()->name }}, your contents will be avilable soon.
  </div>
</div>
@endsection