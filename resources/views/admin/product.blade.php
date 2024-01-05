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

        .font_size {
            font-size: 40px;
            padding-bottom: 40px;
        }

        .text_color {
            color: black
        }

        label {
            display: inline-block;
            width: 250px;
        }

        .div_design {
            padding-bottom: 15px;
        }
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
                    <div class="div_center">
                        <h1 class="font_size">Add Product</h1>
                        <form action="{{ route('addproduct') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="div_design">
                                <label>Product Title:</label>
                                <input type="text" name="title" class="text_color" placeholder="Write a title"
                                    required>
                            </div>
                            <div class="div_design">
                                <label>Product Description:</label>
                                <input type="text" name="description" class="text_color"
                                    placeholder="Write a description" required>
                            </div>
                            <div class="div_design">
                                <label>Product price:</label>
                                <input type="number" name="price" class="text_color" required>
                            </div>
                            <div class="div_design">
                                <label>Product Quantity:</label>
                                <input type="number" name="quantity" class="text_color" min="0" required>
                            </div>

                            <div class="div_design mt-3">
                                <label>Product Category:</label>
                                <select class="text_color" name="category" id="" required>
                                    <option value="" selected="">Add CAtegory Here</option>
                                    @foreach ($category as $value)
                                        <option value="{{ $value->category_name }}">{{ $value->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label>Discount Price:</label>
                                <input type="number" name="discount" class="text_color">
                            </div>

                            <div class="div_design mt-4">
                                <label>Product Image:</label>
                                <input type="file" name="image" required>
                            </div>
                            <div class="div_design">
                                <input type="submit" value="Add Product" class="btn btn-info">
                            </div>
                        </form>

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

</html>
