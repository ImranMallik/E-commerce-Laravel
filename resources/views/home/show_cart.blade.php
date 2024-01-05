<!DOCTYPE html>
<html>

<head>
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
    <title>Mallik - E-commerce Website</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <style>
        .th_data {
            font-size: 30px;
            padding: 5px;
            background: skyblue;
        }

        .total_price {
            text-align: center;
            font-size: 2rem;
            padding: 40px;
        }
        .order{
            /* justify-content: center; */
            text-align: center;
            
        }
        .order_h1{
            font-size: 1.5rem
        }
    </style>

</head>

<body>
    {{-- <div class="hero_area"> --}}
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
    <!-- slider section -->
    <!-- end slider section -->
    
     @if (session()->has('message'))
                           <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                        {{ session()->get('message') }}
                    </div>
                    @endif

    <div class="row d-flex justify-content-center mt-3">
        <div class="col-md-8">
            <table class="table table-bordered border-primary">
                <thead>
                    <tr>
                        <th class="th_data">Product Title</th>
                        <th class="th_data">Quantity</th>
                        <th class="th_data">Price</th>
                        <th class="th_data">Image</th>
                        <th class="th_data">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $totalprice = 0; ?>
                    @foreach ($cart as $value)
                        <tr>
                            <td>{{ $value->product_title }}</td>
                            <td>{{ $value->quantity }}</td>
                            <td>{{ $value->price }}</td>
                            <td><img style="height: 200px; width:200px" src="/product/{{ $value->image }}"
                                    alt=""></td>
                            <td><a onclick="return confirm('Are You Remove This Product ?')"
                                    href="{{ route('remove.cart', $value->id) }}" class="btn btn-danger mt-3">Remove</a>
                            </td>
                        </tr>
                        <?php $totalprice = $totalprice + $value->price; ?>
                    @endforeach
                </tbody>
            </table>
            <div class="total_price">
                <h1>Total Price : {{ $totalprice }}</h1>
            </div>

            <div class="order mb-4">
                <h1 class="order_h1 mb-2">Proceed to Order</h1>
                <a href="{{ route('cash.order') }}" class="btn btn-outline-info">Cash on Delivery</a>
                <a href="{{ route('srtipe.product',$totalprice) }}" class="btn btn-outline-primary">Pay Using Card</a>
            </div>
        </div>
    </div>

    <!-- end client section -->
    <!-- footer start -->
    {{-- @include('home.footer') --}}
    <!-- footer end -->
    <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

        </p>
    </div>

    <!-- jQery -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="js/custom.js"></script>
</body>

</html>
