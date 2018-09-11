@extends('layout')

@section('content')
<div class="container">
  <table class="table table-striped table-hover table-bordered">
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
      <th>Type</th>
      <th>Actions</th>
    </tr>
    @foreach($users as $user)
    <tr>
      <td>{{ $user->id }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>{{ $user->user_type->user_type }}</td>
      <td>
        <form method="POST" action="/users/{{ $user->id }}" onsubmit="return confirm('Are you sure you want to delete {{ $user->name }}')">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
          </form>
      </td>
    </tr>
    @endforeach
  </table>
</div>
@endsection