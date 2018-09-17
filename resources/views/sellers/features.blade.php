@extends('layout')

@section('content')
<div class="container">
<div class="form-group">
    <a href="/features/create" class="btn btn-success">Add Feature</a>
</div>
<table class="table table-condensed table-striped table-bordered table-hover">
    <tr>
        <th>ID</th>
        <th>Parent</th>
        <th>Name</th>
        <th>Created At</th>
        <th colspan="2">Actions</th>
    </tr>
    @foreach($features as $feature)
    <tr>
        <td>{{ $feature->id }}</td>
        <td>
        @foreach($features as $parent)
            @if($parent->id == $feature->parent)
            {{$parent->name}}
            @endif
        @endforeach
        </td>
        <td>{{ $feature->name }}</td>
        <td>{{ $feature->created_at->toFormattedDateString()}}</td>
        <td><a href="/features/edit/{{ $feature->id }}" class="btn btn-primary btn-sm">Edit</a></td>
        <td>
        <form method="POST" action="/features/{{ $feature->id }}" onsubmit="return confirm('Are you sure you want to delete {{ $feature->name }}')">
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