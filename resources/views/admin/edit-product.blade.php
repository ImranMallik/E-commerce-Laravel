<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <base href="/public">
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
                        <form action="{{ route('product_upload',$product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="div_design">
                                <label>Product Title:</label>
                                <input type="text" name="title" class="text_color" placeholder="Write a title"
                                    required value="{{ $product->title }}">
                            </div>
                            <div class="div_design">
                                <label>Product Description:</label>
                                <input type="text" name="description" class="text_color"
                                    placeholder="Write a description" required value="{{ $product->description }}">
                            </div>
                            <div class="div_design">
                                <label>Product price:</label>
                                <input type="number" name="price" class="text_color" required value="{{ $product->price }}">
                            </div>
                            <div class="div_design">
                                <label>Product Quantity:</label>
                                <input type="number" name="quantity" class="text_color" min="0" required value="{{ $product->quantity }}">
                            </div>

                            <div class="div_design mt-3">
                                <label>Product Category:</label>
                                <select class="text_color" style="width: 190px" name="category" id="" required>
                                    <option value="" >Select</option>
                                    @foreach ($category as $value)

                                    <option {{ $value->id == $product->id ?  'selected' : '' }} value="{{ $value->id }}">{{ $value->category_name }}</option>
                                       
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label>Discount Price:</label>
                                <input type="number" name="discount" class="text_color" value="{{ $product->discount_price }}">
                            </div>
                            <div class="div_design mt-4">
                                <label>Curretnt Product Image:</label>
                                
                                <img style="margin: auto" width="100px" height="100px" src="/product/{{ $product->image }}" alt="">
                            </div>

                            <div class="div_design mt-4">
                                <label>Product Image:</label>
                                <input type="file" name="image">
                            </div>
                            <div class="div_design">
                                <input type="submit" value="Update Product" class="btn btn-info">
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
