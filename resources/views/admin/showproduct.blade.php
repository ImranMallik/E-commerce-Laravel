<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style>
        .title{
            text-align: center;
        }

        .title, h1{
            font-size: 24px;
        }
        .image_size{
            width:100px;
            height: 100px;
        }
       
        /* .image{
            object-fit: cover;
        } */
       
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.header')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                      @if (session()->has('message'))
                           <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    <div class="title">
                        <h1>All Product</h1>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-12">
                            <table class="table table-bordered border-primary">
                                <thead>
                                    <tr>
                                        <th >ID</th>
                                        <th style="width: 13%" >Image</th>
                                        <th style="width: 10%">Title</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Discount</th>
                                        <th>Delete</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $value)
                                    <tr>
                                        <th scope="row">{{ $value->id }}</th>
                                        <td class="image_size"><img style="object-fit: cover" src="/product/{{ $value->image }}"  alt=""></td>
                                        <td>{{ $value->title }}</td>
                                        <td>{{ $value->description }}</td>
                                        <td>{{ $value->category }}</td>
                                        <td>{{ $value->price }}</td>
                                        <td>{{ $value->quantity }}</td>
                                        <td>{{ $value->discount_price }}</td>
                                        <td><a href="{{ route('delete.product',$value->id) }}" class="btn btn-danger" onclick="return confirm('Are You Sure To Delete This Data?')";>Delete</a></td>
                                        <td><a href="{{ route('product.update',$value->id) }}" class="btn btn-primary">Edit</a></td>
                                    </tr>
                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>

</html>admin/
