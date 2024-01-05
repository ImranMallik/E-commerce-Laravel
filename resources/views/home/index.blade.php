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
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
         @include('home.slider')
         <!-- end slider section -->
      </div>
      <!-- why section -->
        @include('home.why')
      <!-- end why section -->
      
      <!-- arrival section -->
      @include('home.arrival')
      <!-- end arrival section -->
      
      <!-- product section -->
      @include('home.product')
      <!-- end product section -->

      <div style="text-align: center; padding-bottom:30px;">
         <h1 style="font-size:30px; text-align:center; padding-top:20px;padding-bottom: 20px">Comments</h1>

         <form action="{{ route('add_comment') }}" method="POST">
            @csrf
            <textarea style="height: 150px; width:600px" name="comment" placeholder="Comment Something here"></textarea>
            <br>
            <input type="submit" class="btn btn-info" value="Comment">

         </form>
      </div>
      <div style="padding-left:20%">
         <h1 style="font-size:20px; padding-bottom:20px;">All Comments</h1>
         @foreach ($comment as $value)
         <div class="mb-3">
            <b>{{ $value->name }}</b>
            <p>{{ $value->comment }}</p>
            
            <a href="javascript::void(0);" onclick="reply(this)" data-commentid= "{{ $value->id }}">Reply</a>
          @foreach ($reply as $rep)
          @if($rep->comment_id==$value->id)
          <div style="padding-left: 3%; padding-bottom:10px;">
             <b>{{ $rep->name }}</b>
             <p>{{ $rep->reply }}</p>
          </div>
            @endif
          @endforeach
         
         </div>
         
         @endforeach
       
         <div style="display: none" class="replyDiv mt-2">
            <form action="{{ route('add_reply') }}" method="POST">
               @csrf
               <input type="text" id="commentId" name="commentId" hidden="">
               <textarea style="height:100px; width:350px;" name="reply" placeholder="write something here"></textarea>
               <br>
               <button type="submit"  class="btn btn-warning mb-5">Reply</button>
               <a href="javascript::void(0);" class="btn btn-danger mb-5" onclick="reply_close(this)">Close</a>
            </form>
         </div>
      </div>


      <!-- subscribe section -->
       @include('home.subscribe')
      <!-- end subscribe section -->
      <!-- client section -->
      @include('home.client')
      <!-- end client section -->
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <script>

         function reply(caller){

            document.getElementById('commentId').value=$(caller).attr('data-commentid');
            $('.replyDiv').insertAfter($(caller));
            $('.replyDiv').show();
         }

         function reply_close(caller){
            $('.replyDiv').hide();
         }
      </script>
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