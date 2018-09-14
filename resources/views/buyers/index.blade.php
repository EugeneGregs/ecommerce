@extends('layout')

@section('content')
      <div class="row">

        <div class="col-lg-3">

          <h1 class="my-4">Filter</h1>
          <div class="list-group">

          @foreach( $categories as $category)
            @if( $category->parent == 0 )
            <a href="#" class="list-group-item">{{ $category->name }}</a>
            @endif
          @endforeach
          </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">
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
              @foreach( $products->paginate(5) as $product)
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
        <div class="shadow bg-white rounded">
          <div class="row" style="padding-top: 10px">

            @foreach( $products->paginate(10) as $product )
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <a href="#"><img class="card-img-top" src="/storage/images/{{ $product->image }}" alt="{{ $product->name }} Image"></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">{{ $product->name }}</a>
                  </h4>
                  <h5>KES {{ $product->price }}</h5>
                  <p class="card-text">{{ $product->description }}</p>
                </div>
                <div class="card-footer">
                  <small class="text-muted"></small>
                  <div class="float-right">
                  <a href="" class="btn btn-info btn-sm">View</a>
                  <a href="" class="btn btn-primary btn-sm">Add to Cart</a>
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
        <!-- /.col-lg-9 -->
      </div>
      <!-- /.row -->
@endsection