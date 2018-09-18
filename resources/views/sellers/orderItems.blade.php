@extends('layout')

@section('content')
<div class="container">
<table class="table table-condensed table-striped table-bordered table-hover">
    <tr>
        <th>#</th>
        <th>Product Name</th>
        <th>Product Status</th>
        <th>Quantity</th>
        <th>Amount</th>
        <th>Total</th>
    </tr>
    <?php $count = 0 ?>
    @foreach( $items as $item )
    @foreach( Auth::user()->products as $product )
    @if( $item->product_id == $product->id )
    <tr>
        <td>
          {{ ++$count }} 
        </td>
        <td>
          {{ $product->name }} 
        </td>
        <td>
           @if( $product->status == 1 )
            {{ "Available" }} 
            @else
            {{ "Out of Stock" }}
            @endif
        </td>
        <td>
          {{ $item->quantity }}
        </td>
        <td>
          {{ number_format($product->price, 2, '.' , ',') }}
        </td>
        <td>
          <?php $total = $product->price * $item->quantity ?>
          {{ number_format($total, 2, '.' , ',') }}
        </td>
    </tr>
    @endif
    @endforeach
    @endforeach
</table>
</div>
@endsection