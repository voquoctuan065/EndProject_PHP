<!DOCTYPE html>
<html>

<head>
    <base href="/public">
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
    <title>Product Details</title>
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
        <!-- end header -->

        <section class="product_section layout_padding">
            <div class="container">
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="img-box">
                        <img src="/product/{{$product->image}}" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            {{$product->title}}
                        </h5>
                        @if($product->discount != null)
                        <h6>
                            Discount price
                            <br>
                            ${{$product->discount}}
                        </h6>
                        <h6>
                            Price
                            <br>
                            ${{$product->price}}
                        </h6>
                        @else
                        <h6>
                            Price
                            <br>
                            ${{$product->price}}
                        </h6>
                        @endif
                        <h6>Product Category: {{$product->category}}</h6>
                        <h6>{{$product->description}}</h6>

                        <a href="" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
    </div>
    </section>

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