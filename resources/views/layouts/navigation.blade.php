<nav class="navbar navbar-expand-lg navbar-light bg-light">
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
   <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav" style="left: 30px;">
        @if(Auth::user()->user_type->user_type == "Admin")
         <li class="nav-item active">
            <a class="nav-link" href="/categories">Categories</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="/users">Users</a>
         </li>
         @endif
         @if(Auth::user()->user_type->user_type == "Seller")
         <li class="nav-item dropdown active">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    Products <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/products">
                    All Products
                </a>
                <a class="dropdown-item" href="/features">
                    Product Features
                </a>
            </div>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="/orders">Orders</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="#">Reviews</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="#s">Reports</a>
         </li>
         @endif
         <li class="nav-item dropdown top-right">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
      </ul>
   </div>
</nav>