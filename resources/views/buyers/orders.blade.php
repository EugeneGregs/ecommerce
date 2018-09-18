@extends('layout')

@section('content')
<div class="container">
<table class="table table-condensed table-striped table-bordered table-hover">
    <tr>
        <th>#</th>
        <th>Order Number</th>
        <th>Order Status</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>
    <?php $count = 0 ?>
    @foreach( Auth::user()->orders as $order )
    <tr>
        <td>
          {{ ++$count }} 
        </td>
        <td>
          {{ $order->order_number }} 
        </td>
        <td>
           {{ $order->orderStatus->status_type }}
        </td>
        <td>
          {{ $order->created_at->toFormattedDateString() }}
        </td>
        <td><a href="/orderItemsHistory/{{ $order->id }}" class="btn btn-primary btn-sm">View Order</a></td>
    </tr>
    @endforeach
</table>
</div>
@endsection