<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.navbar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @if (session()->has('message'))
                    <div class="alert alert-success">
                        <button class="close" data-dismiss="alert" aria-hidden="true" type="button">x</button>
                        {{session()->get('message')}}
                    </div>
                    @endif
                    <div>
                        <h2 class="text-center font-weight-bold mb-5">Product information</h2>
                    </div>

                    <table class="table mt-5">
                        <thead>
                            <th>Product title</th>
                            <th>Product description</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Category</th>
                            <th>Discount</th>
                            <th>Image</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </thead>
                        <tbody>
                            @foreach($product as $product)
                            <tr>
                                <th scope="row">{{$product->title}}</th>
                                <th scope="row">{{$product->description}}</th>
                                <th scope="row">{{$product->price}}</th>
                                <th scope="row">{{$product->quantity}}</th>
                                <th scope="row">{{$product->category}}</th>
                                <th scope="row">{{$product->discount}}</th>
                                <th scope="row"><img src="product/{{$product->image}}" alt=""></th>
                                <td>
                                    <a href="{{url('delete_product', $product->id)}}" class="btn btn-outline-danger" onclick="return confirm('Are you sure to delete this ?')">Delete</a>
                                </td>
                                <td>
                                    <a href="{{url('update_product', $product->id)}}" class="btn btn-outline-success">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')
</body>

</html>