<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
    </div>

    <!-- Start card section -->
    <section class="h-100" style="background-color: #eee;">
        <div class="container h-100 py-5">
            @if (session()->has('message'))
            <div class="alert alert-success">
                <button class="close" data-dismiss="alert" aria-hidden="true" type="button">x</button>
                {{session()->get('message')}}
            </div>
            @endif
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
                    </div>
                    <?php $total_price = 0; ?>
                    @foreach($cart as $cart)
                    <div class="card rounded-3 mb-4">
                        <div class="card-body p-4">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                    <img src="/product/{{$cart->image}}" class="img-fluid rounded-3" alt="Cotton T-shirt">
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3">
                                    <p class="lead fw-normal mb-2">{{$cart->product_title}}</p>
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                    <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                        <i class="fa fa-minus"></i>
                                    </button>

                                    <input id="form1" min="1" name="quantity" value="{{$cart->quantity}}" type="number" class="form-control form-control-sm" style="width: 80px;" />

                                    <button class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                    <h5 class="mb-0">${{$cart->price}}</h5>
                                </div>
                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                    <a href="{{url('remove_cart', $cart->id)}}" class="text-danger" onclick="return confirm('Do you want to remove this item?')">
                                        <i class="fa fa-trash fa-lg"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $total_price = $total_price + $cart->price ?>
                    @endforeach
                    <div class="card mb-4">
                        <div class="card-body p-4 d-flex flex-row">
                            Total Price: ${{$total_price}}
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h1>Proceed to Pay</h1>
                            <a href="{{url('cash_order')}}" class="btn btn-outline-danger btn-block btn-lg" onclick="return confirm('Are you sure to buy?')">Cash on Delivery</a>
                            <a href="{{url('stripe', $total_price)}}" class="btn btn-outline-warning btn-block btn-lg mt-2">Pay Using Card</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End cart section -->

    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->
    <!-- jQery -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>
</body>

</html>