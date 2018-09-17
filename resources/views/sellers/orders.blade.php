@extends('layout')

@section('content')
<div class="container">
<table class="table table-condensed table-striped table-bordered table-hover">
    <tr>
        <th>#</th>
        <th>Order Number</th>
        <th>Order Status</th>
        <th>Created At</th>
        <th colspan="2">Actions</th>
    </tr>
    <?php $count = 0 ?>
    @foreach( Auth::user()->placedOrders as $order )
    @if( ($order->order_status_id == 2) || ($order->order_status_id == 3) )
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
        @if( count($order->orderUsers()->where('user_id', Auth::user()->id)->where('completed', 0)->get()) )
        <td>
          <a href="/completeOrder/{{ $order->id }}" class="btn btn-primary btn-sm">Complete</a>
        </td>
        @endif
        <td><a href="" class="btn btn-primary btn-sm">View Order</a></td>
    </tr>
    @endif
    @endforeach
</table>
</div>
@endsection