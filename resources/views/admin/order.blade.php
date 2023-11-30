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
                    <h2 class="text-center font-weight-bold mb-5">All order</h2>

                    <div>
                        <form action="{{url('search')}}" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="search" placeholder="Search something" id="" class="mr-2 form-control">
                                <input type="submit" value="Search" class="btn btn-danger">
                            </div>
                        </form>
                    </div>

                    <table class="mt-5 border">
                        <thead class="bg-warning">
                            <th>Customer_name</th>
                            <th>Email</th>
                            <th>Phone_Number</th>
                            <th>Address</th>
                            <th>Product_Title</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Payment_Status</th>
                            <th>Delivery_Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @forelse($order as $order)
                            <tr>
                                <td>{{$order->name}}</td>
                                <td>{{$order->email}}</td>
                                <td>{{$order->phone}}</td>
                                <td>{{$order->address}}</td>
                                <td>{{$order->product_title}}</td>
                                <td>{{$order->quantity}}</td>
                                <td>${{$order->price}}</td>
                                <td><img src="/product/{{$order->image}}" style="height: 40px; widht: 40px;"></td>
                                <td>{{$order->payment_status}}</td>
                                <td>{{$order->delivery_status}}</td>
                                <td>
                                    @if($order->delivery_status == 'processing')
                                    <a href="{{url('delivered', $order->id)}}" class="btn btn-info" onclick="return confirm('Order shipping confirmation?')">Delivered</a>
                                    @else
                                    <h6 class="text-center">Delivered</h6>
                                    @endif
                                    <a href="{{url('print_pdf', $order->id)}}" class="btn btn-light mt-2">Print PDF</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="16" class="text-center">No data found</td>
                            </tr>
                            @endforelse
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