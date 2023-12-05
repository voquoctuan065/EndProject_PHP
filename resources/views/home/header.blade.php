<header class="header_section bg-warning">
   <div class="container">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
         <a class="navbar-brand" href="{{url('/')}}"><h2 class="text-danger">End Project</h2></a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
         </button>
         <div class="navbar-collapse" id="navbarSupportedContent">
            <form action="{{url('product_search')}}" method="post" style="margin-left: 45px;">
                  @csrf
                  <div class="d-flex align-items-center" style="padding-top: 12px;">
                     <input type="text" name="search" placeholder="Search something here" class="form-control">
                     <button type="submit" class="btn" style="padding-bottom: 22px;"> <i class="fa fa-search"></i></button>
                  </div>
            </form>
            <ul class="navbar-nav">
               <li class="nav-item active">
                  <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#product">Products</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{url('show_cart')}}">Cart</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{url('show_order')}}">Order</a>
               </li>

               @if (Route::has('login'))
               @auth
               <li class="nav-item">
                  <x-app-layout>

                  </x-app-layout>
               </li>
               @else
               <li class="nav-item">
                  <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
               </li>
               <li class="nav-item ml-2">
                  <a class="btn btn-success" href="{{ route('register') }}">Register</a>
               </li>
               @endauth
               @endif
            </ul>
         </div>
      </nav>
   </div>
</header>