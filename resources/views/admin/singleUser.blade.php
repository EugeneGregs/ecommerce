@extends('layout')

@section('content')
<div class="container">
  <div class="card card-primary">
    <div class="card-header">
      Viewing {{ $user->name }}
    </div>
    <div class="card-body">
      Name: {{ $user->name }}</br>
      Email: {{ $user->email }}</br>
      Role: {{ $user->user_type->user_type }}</br>
      Account Created: {{ $user->created_at->toFormattedDateString() }}</br>
    </div>
    <div class="card-footer justify-content-centre">
      <form action="/users/{{ $user->id }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <a href="/users" class="btn btn-warning btn-sm">BACK</a>
        <button class="btn btn-danger btn-sm" type="submit">DELETE</button>
      </form>
    </div>
  </div>
</div>
@endsection