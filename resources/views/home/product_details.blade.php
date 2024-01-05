<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <base href="/pablic">
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
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')

        <div class="card">
            <div class="card-head">
                <h2 class="mt-2"
                    style="font-size: 3rem;font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; text-align:center;color:rgb(138, 21, 21)">
                    Product Deatails</h2>
            </div>
            <div class="card-body">

                <div class="col-sm-6 col-md-4 col-lg-4" style="margin: auto; width:50%;padding:30px;">
                    <div class="box ">

                        <div class="img-box ">
                            <img src="product/{{ $value->image }}" alt="">
                        </div>
                        <div class="detail-box mt-3">
                            <h5>
                                {{ $value->title }}
                            </h5>
                            @if ($value->discount_price != null)
                                <h6 style="color: red">
                                    Discount price
                                    <br>
                                    ${{ $value->discount_price }}
                                </h6>
                                <h6 style="text-decoration:line-through;color:blue">
                                    Price
                                    <br>
                                    ${{ $value->price }}
                                </h6>
                            @else
                                <h6 style="color:blue">
                                    Price
                                    <br>
                                    ${{ $value->price }}
                                </h6>
                            @endif
                            <h6 class="mt-1">
                                Desctiption : {{ $value->description }}
                            </h6>
                            <h6 class="mt-1">Category : {{ $value->category }}</h6>
                            <h6 class="mt-1">Product Quantity : {{ $value->quantity }}</h6>
                            <form class="mt-2" action="{{ route('add.cart', $value->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" name="quantity" value="1" min="1"
                                            style="width: 100px">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="submit" class="rounded-pill" value="Add To Cart">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>





    <!-- footer start -->
    @include('home.footer')
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
