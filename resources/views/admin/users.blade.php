@extends('layout')

@section('content')
<div class="container">
  <table class="table table-striped table-hover table-bordered">
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
      <th>Type</th>
      <th colspan="3">Actions</th>
    </tr>
    @foreach($users as $user)
    <tr>
      <td>{{ $user->id }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>{{ $user->user_type->user_type }}</td>
      <td><button class="btn btn-sm btn-primary">View</button></td>
      <td><button class="btn btn-sm btn-warning">Block</button></td>
      <td><button class="btn btn-sm btn-danger">Delete</button></td>
    </tr>
    @endforeach
  </table>
</div>
@endsection