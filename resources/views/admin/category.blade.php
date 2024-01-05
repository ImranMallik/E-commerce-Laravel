<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style>
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .headding {
            font-size: 40px;
            padding-bottom: 40px;
        }

        .inp_color {
            color: black
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.header')
        <div class="main-panel">
            <div class="content-wrapper">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="div_center">
                    <h2 class="headding">Add Category</h2>

                    <form action="{{ route('create.category') }}" method="POST">
                        @csrf
                        <input type="text" class="inp_color" name="name" placeholder="Write category name">
                        <input type="submit" class="btn btn-primary" name="submit" id="">
                    </form>

                </div>


                <div class="d-flex  justify-content-center mt-3">

                    <h3 class="text-info">Category Table</h3>
                </div>
                <div class="row d-flex  justify-content-center mt-4">
                    <div class="col-md-8 table-striped table-bordered border-primary">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 15%">Id</th>
                                    <th scope="col" style="width:20%">Category Name</th>
                                    <th scope="col"style="width: 20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $value)
                                    <tr>
                                        <th scope="row">{{ $value->id }}</th>
                                        <td>{{ $value->category_name }}</td>
                                        <td>
                                            {{-- <a href="" class="btn btn-outline-primary">Edit</a> --}}
                                            <a onclick="return confirm('Are You Sure To Delete This')"
                                                href="{{ route('category.delete', $value->id) }}"
                                                class="btn btn-outline-danger mx-2">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>

</html>admin/
