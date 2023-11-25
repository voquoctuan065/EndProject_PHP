<!DOCTYPE html>
<html lang="en">

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    @if (session()->has('message'))
                    <div class="alert alert-success">
                        <button class="close" data-dismiss="alert" aria-hidden="true" type="button">x</button>
                        {{session()->get('message')}}
                    </div>
                    @endif
                    <div>
                        <h2 class="text-center font-weight-bold mb-5">Edit product</h2>

                        <form action="{{url('/update_product_confirm', $product->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="productTitle">Product title</label>
                                <input type="text" class="form-control" name="productTitle" value="{{$product->title}}" />
                            </div>
                            <div class="form-group">
                                <label for="productDescription">Product description</label>
                                <input type="text" class="form-control" name="productDescription" value="{{$product->description}}" />
                            </div>
                            <div class="form-group">
                                <label for="productImage">Product image</label>
                                <input type="file" class="form-control" name="productImage" value="{{$product->image}}"/>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" name="quantity" value="{{$product->quantity}}"/>
                            </div>
                            <div class="form-group">
                                <label for="productPrice">Product price</label>
                                <input type="number" class="form-control" name="productPrice" value="{{$product->price}}" />
                            </div>
                            <div class="form-group">
                                <label for="discount">Discount</label>
                                <input type="number" class="form-control" name="discount" value="{{$product->discount}}" />
                            </div>
                            <div class="form-group">
                                <label for="productOfCategory">Product of Category</label>
                                <select class="form-control" name="productOfCategory" id="">
                                    <option value="{{$product->category}}" selected>{{$product->category}}</option>
                                    @foreach($category as $category)
                                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="mt-3 btn btn-primary">Update product</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>