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
        .center{
            margin: auto;
            width: 70%;
            padding: 30px;
            text-align: center;
        }
        .center{
            padding-left: 150px;
        }
        table,th,td{
            border: 2px solid black;
        }
        .head{
            padding: 10px;
            background-color: skyblue;
            font-size: 20px;
            font-weight: bold;
        }
      </style>
   </head>
   <body>
         <!-- header section strats -->
         @include('home.header')
         
         <div class="center mt-3">
            <table>
                <tr>
                    <th class="head">Product Title</th>
                    <th class="head">Quantity</th>
                    <th class="head">Price</th>
                    <th class="head">Payment Status</th>
                    <th class="head">Delivery Status</th>
                    <th class="head">Image</th>
                    <th class="head">Cancel Order</th>
                </tr>
                @foreach ($order as $value)
                <tr>
                    <td>{{ $value->product_title }}</td>
                    <td>{{ $value->quantity }}</td>
                    <td>{{ $value->price }}</td>
                    <td>{{ $value->payment_status }}</td>
                    <td>{{ $value->delivery_status }}</td>
                    <td>
                        <img style="height: 100px; width:110px;" src="product/{{ $value->image }}" alt="">
                    </td>
                    <td>
                        @if ($value->delivery_status='processing')
                        <a class="btn btn-danger" onclick="return confirm('Are You Sure To Cancel !!!')" href="{{ route('cancel_order',$value->id) }}">Calcel order</a>
                            
                        @else
                        <p class="btn btn-warning">Not Allowed</p>
                        @endif
                    </td>
                </tr>
                    
                @endforeach
            </table>
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