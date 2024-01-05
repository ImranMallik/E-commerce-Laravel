<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
        .title_dg{
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            padding-bottom: 40px;
        }
        .table_deg{
            border: 2px solid white;
            width: 100%;
            margin: auto;
            /* padding-top: 50px; */
            text-align: center;
        }
        .th_deg{
            background: skyblue;
        }
        .order_img{
            height: 100px;
            width: 1 00px;
        }
    </style>
  </head>
  <body> style ="padding: 10px" 
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
                <h1 class="title_dg">All Order</h1>

                <div style="padding-left:400px; padding-bottom:30px; color:black;">
                    <form action="{{ route('search_order') }}" method="GET">
                        @csrf
                        <input type="text" name="search" placeholder="Search For Something">

                        <input type="submit" class="btn btn-outline-primary" value="search" id="">
                    </form>
                </div>

                <table class="table-bordered  table_deg">
                    <tr class="th_deg">
                        <th style ="padding: 10px" >Name</th>
                        <th style ="padding: 10px" >Email</th>
                        <th style ="padding: 10px" >Address</th>
                        <th style ="padding: 10px" >Phone</th>
                        <th style ="padding: 10px" >Product Title</th>
                        <th style ="padding: 10px" >Quantity</th>
                        <th style ="padding: 10px" >price</th>
                        <th style ="padding: 10px" >Payment Status</th>
                        <th style ="padding: 10px" >Delivery Status</th>
                        <th style ="padding: 10px" >Image</th>
                        <th style ="padding: 10px" >Delivered</th>
                        <th style ="padding: 10px" >Send E-mail</th>
                    </tr>
                    @forelse ($order as $value)
                    <tr>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->address }}</td>
                        <td>{{ $value->phone }}</td>
                        <td>{{ $value->product_title }}</td>
                        <td>{{ $value->quantity }}</td>
                        <td>{{ $value->price }}</td>
                        <td>{{ $value->payment_status }}</td>
                        <td>{{ $value->delivery_status }}</td>
                        <td>
                            <img class="order_img" src="/product/{{$value->image}}">
                        </td>
                        <td>
                            @if ($value->delivery_status == 'processing')
                            <a onclick="return confirm('Are You Sure this product is delivered !!!')" href="{{ route('order.delivered',$value->id) }}" class="btn btn-warning">Delivered</a>
                            @else
                            <p style="color: green">Delivered</p>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('send_email',$value->id) }}" class="btn btn-info p-0">Send Email</a>
                        </td>
                       
                    </tr>

                    @empty
                     
                    <tr>
                        <td colspan="16">
                            No Data Found
                        </td>
                    </tr>
                        
                    @endforelse
                </table>
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