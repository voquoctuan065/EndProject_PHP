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
                        <h2 class="text-center font-weight-bold mb-5">Add product</h2>

                        <form action="{{url('/add_product')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="productTitle">Product title</label>
                                <input type="text" class="form-control" name="productTitle" placeholder="Enter product title" />
                            </div>
                            <div class="form-group">
                                <label for="productDescription">Product description</label>
                                <input type="text" class="form-control" name="productDescription" placeholder="Enter product description" />
                            </div>
                            <div class="form-group">
                                <label for="productImage">Product image</label>
                                <input type="file" class="form-control" name="productImage" />
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" name="quantity" placeholder="Enter quantity" />
                            </div>
                            <div class="form-group">
                                <label for="productPrice">Product price</label>
                                <input type="number" class="form-control" name="productPrice" placeholder="Enter product price" />
                            </div>
                            <div class="form-group">
                                <label for="discount">Discount</label>
                                <input type="number" class="form-control" name="discount" placeholder="Enter discount price" />
                            </div>
                            <div class="form-group">
                                <label for="productOfCategory">Product of Category</label>
                                <select class="form-control" name="productOfCategory" id="">
                                    @foreach($category as $category)
                                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Add product</button>
                        </form>
                    </div>

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