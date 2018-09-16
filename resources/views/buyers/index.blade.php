@extends('layout')

@section('content')
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-2">

          <h3 class="my-4">Filter By:</h3>
          <h5>Category</h5><hr>
          <div class="list-group">
          @foreach( $categories as $category)
            @if( $category->parent == 0 )
            <a href="#" class="list-group-item">{{ $category->name }}</a>
            @endif
          @endforeach
          </div><hr>

          <h5>Date</h5><hr>
          <div class="list-group">
            <a href="#" class="list-group-item">January</a>
            <a href="#" class="list-group-item">February</a>
            <a href="#" class="list-group-item">February</a>
          </div>

        </div>
        <!-- /.col-lg-3 -->
        
        <div class="col-lg-6">
        <div class="shadow bg-white rounded">
          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active" style="background-color: #444"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1" style="background-color: #999"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2" style="background-color: #999"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="3" style="background-color: #999"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="4" style="background-color: #999"></li>
            </ol>
            <div class="carousel-inner" role="listbox" style="width: 100%; height: 350px; !important;">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="/storage/images/banner_image.gif" alt="Banner Image" style="width: 100%;">
              </div>
              @foreach( $products as $product)
              <div class="carousel-item" style="height: 200px;">
                <img class="d-block img-fluid" src="/storage/images/{{ $product->image }}" alt="{{ $product->name }} Image" style="width: 100%; height: 350px;">
                <div class="carousel-caption d-none d-md-block">
                  <h5 class="text-primary">KES {{ $product->price }} </h5>
                </div>
              </div>
              @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
          <div class="row" style="padding-top: 10px">

            @foreach( $products as $product )
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="/storage/images/{{ $product->image }}" alt="{{ $product->name }} Image"></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">{{ $product->name }}</a>
                  </h4>
                  <h5>KES {{ number_format($product->price, 2, '.' , ',') }}</h5>
                  <p class="card-text">{{ $product->description }}</p>
                </div>
                <div class="card-footer">
                  <small class="text-muted"></small>
                  <div class="float-right">
                  <a href="" class="btn btn-info btn-sm">View</a>
                  <button class="btn btn-primary btn-sm" onclick="addToCart('{{ json_encode($product) }}','{{ Auth::user()->id }}', '@if( count($cartItems) ) {{ $orderId }} @endif' )">Add to Cart</button>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <!-- /.row -->
        </div>
        <!-- /.shadow -->
        </div>
        <!-- /.col-lg-6 -->

        <div class="col-lg-4">
            <br/>
              <div class="card rounded">
                <div class="card-body">
                    <h6 class="card-title text-success">Shopping Cart</h6>
                  <table class="table table-hover" id="shoppingCart">
                    <tr>
                      <th>Item</th>
                      <th>Quantity</th>
                      <th colspan="3" style="text-align: center">Action</th>
                    </tr>
                    @foreach( $cartItems as $item )
                      @foreach( $products as $product )
                        @if( $item->product_id == $product->id )
                        <tr>
                          <td>{{ $product->name }}</td>
                          <td id="quantity">{{ $item->quantity }}</td>
                          <td><button class="btn btn-primary btn-sm" onclick="addQuantity('{{ json_encode($item) }}','{{ Auth::user()->id }}', prompt('Enter Quantity: '))">Quantity</button></td>
                          <td><button class="btn btn-danger btn-sm" onclick="removeCart('{{ $item->product_id }}')">Remove</button></td>
                        </tr>
                        @endif
                      @endforeach
                    @endforeach
                  </table>
              </div>
            </div>

             <br/>
              <div class="card rounded" style="display: none">
                <div class="card-body">
                    <h6 class="card-title text-success"> Cashier: </h6>
                  <p class="text-info">Total Amount: KES <span id="total"></span></p>
                  <button class="btn btn-warning btn-sm" onclick="clearCart('{{ $orderId }}')">Clear Cart</button>
              </div>
            </div>

        </div>
<!-- /.col-lg-4 -->

</div>
<!-- /.row -->
</div>
<!-- /.container -->
@endsection

@section('pagescript')
<script src="/js/orderScript.js"></script>
@stop