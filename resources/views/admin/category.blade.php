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
                        <h2 class="text-center font-weight-bold mb-5">Add category</h2>

                        <form action="{{url('/add_category')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="categoryName">Category name</label>
                                <input type="text" class="form-control" name="categoryName" placeholder="Enter category name" />
                            </div>
                            <button type="submit" class="btn btn-primary">Add category</button>
                        </form>
                    </div>

                    <table class="table mt-5">
                        <thead>
                            <th>Category Name</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($data as $data)
                            <tr>
                                <th scope="row">{{$data->category_name}}</th>
                                <td colspan="2" class="table-active">
                                    <a href="{{url('delete_category', $data->id)}}" class="btn btn-danger"
                                    onclick="return confirm('Are you sure to delete this ?')"
                                    >Delete</a>
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