@extends('layout')

@section('content')
<div class="container">
<div class="form-group">
    <a href="/categories/create" class="btn btn-success">Add Category</a>
</div>
<table class="table table-condensed table-striped table-bordered table-hover">
    <tr>
        <th>ID</th>
        <th>Parent</th>
        <th>Name</th>
        <th>Created At</th>
        <th colspan="2">Actions</th>
    </tr>
    @foreach($categories as $Category)
    <tr>
        <td>{{ $Category->id }}</td>
        <td>
        @foreach($categories as $parent)
            @if($parent->id == $Category->parent)
            {{$parent->name}}
            @endif
        @endforeach
        </td>
        <td>{{ $Category->name }}</td>
        <td>{{ $Category->created_at->toFormattedDateString()}}</td>
        <td><a href="/categories/edit/{{ $Category->id }}" class="btn btn-primary btn-sm">Edit</a></td>
        <td>
        <form method="POST" action="/categories/{{ $Category->id }}" onsubmit="return confirm('Are you sure you want to delete {{ $Category->title }}')">
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

@section('pagescript')
<script src="/js/custom.js"></script>
@stop