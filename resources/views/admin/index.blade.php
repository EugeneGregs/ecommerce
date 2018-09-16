@extends('layout')

@section('content')
<div class="container">
  <div class="alert alert-info">Welcome! {{ $userType->user_type }}</div>
</div>
@endsection