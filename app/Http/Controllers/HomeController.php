<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;
use Stripe;

class HomeController extends Controller
{
    //
    public function index()
    {
        $product = Product::paginate(10);
        
        $comment = Comment::orderby('id','desc')->get();
        $reply=Reply::all();
        return view('home.index', compact('product','comment','reply'));
    }



    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == '1') {
            $total_product = Product::all()->count();
            $total_order = Order::all()->count();
            $total_user = User::all()->count();
            $order = Order::all();
            $total_revenue = 0;

            foreach($order as $value){
                $total_revenue = $total_revenue + $value->price;
            }

            $total_delivered=Order::where('delivery_status','=','Delivered')->get()->count();

            $total_processing = Order::where('delivery_status', '=', 'processing')->get()->count();

            return view('admin.index',compact('total_product','total_order','total_user','total_revenue','total_delivered','total_processing'));
        } else {
            $product = Product::paginate(10);

            $reply = Reply::all();

            $comment=Comment::all();
            return view('home.index', compact('product','comment','reply'));
        }
        
    }


    public function product_deatails($id)
    {
        $value = Product::findorFail($id);
        return view('home.product_details', compact('value'));
    }

    public function add_cart(Request $request, $id)
    {
        if (Auth::id()) {
            // return redirect()->back();
            $user = Auth::user();
            // dd($user);
            $product = Product::findOrFail($id);

            $cart = new Cart;
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->product_title = $product->title;

            if ($product->discount_price != null) {
                $cart->price = $product->discount_price * $request->quantity;
            } else {

                $cart->price = $product->price * $request->quantity;
            }
            $cart->image = $product->image;
            $cart->product_id = $product->id;
            $cart->quantity = $request->quantity;
            $cart->save();

            return redirect()->back();
        } else {
            return redirect('login');
        }
    }

    //show cart

    public function cartShow()
    {

        if (Auth::id()) {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', '=', $id)->get();
            return view('home.show_cart', compact('cart'));
        } else {
            return redirect('login');
        }
    }


    public function removeCart($id)
    {
        $removeCart = Cart::findOrFail($id);
        $removeCart->delete();

        return redirect()->back();
    }

    public function cashorder(){
        $user = Auth::user();
        $userId = $user->id;
        $cart = Cart::where('user_id','=',$userId)->get();
        // dd($data);
        foreach($cart as $cart){

            $order = new Order;
    
            $order->name = $cart->name;
            $order->email = $cart->email;
            $order->phone = $cart->phone;
            $order->address = $cart->address;
            $order->product_title = $cart->product_title;
            $order->price = $cart->price;
            $order->quantity = $cart->quantity;
            $order->product_id = $cart->product_id;
            $order->user_id = $cart->user_id;
            $order->image = $cart->image;
            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'processing';
            $order->save();

            $cart_Id = $cart->id;
            $cart_data = Cart::findOrFail($cart_Id);
            $cart_data->delete();
        }
           return redirect()->back()->with('message','We have Receive your Order. We will connect with you soon..');
    }

    public function stripe($totalprice){
        return view('home.stripe',compact('totalprice'));
    }

    public function stripePost(Request $request,$totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $totalprice * 78,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks for Payment."
        ]);

        $user = Auth::user();
        $userId = $user->id;
        $cart = Cart::where('user_id', '=', $userId)->get();
        // dd($data);
        foreach ($cart as $cart) {

            $order = new Order;

            $order->name = $cart->name;
            $order->email = $cart->email;
            $order->phone = $cart->phone;
            $order->address = $cart->address;
            $order->product_title = $cart->product_title;
            $order->price = $cart->price;
            $order->quantity = $cart->quantity;
            $order->product_id = $cart->product_id;
            $order->user_id = $cart->user_id;
            $order->image = $cart->image;
            $order->payment_status = 'Paid';
            $order->delivery_status = 'processing';
            $order->save();

            $cart_Id = $cart->id;
            $cart_data = Cart::findOrFail($cart_Id);
            $cart_data->delete();
        }

        Session::flash('success', 'Payment successful!');

        return back();
    }

    public function showOrder(){
        if(Auth::id()){
            $user=Auth::user();
            $userid=$user->id;

            $order=Order::where('user_id','=',$userid)->get();
            return view('home.order',compact('order'));
        } else{
            return redirect('login');
        }
    }

    public function cancelOrder($id){
       
        $order = Order::findOrFail($id);
        $order->delivery_status = 'You Cancel The Order';
        $order->save();
        return redirect()->back();
    }

    public function addComment(Request $request){
           if(Auth::id()){
                $comment = new Comment();
                $comment->name=Auth::user()->name;
                $comment->user_id=Auth::user()->id;
                $comment->comment = $request->comment;

                $comment->save();
                return redirect()->back();

           }else{
            return redirect('login');
           }
    }

    public function addReply(Request $request){
             if(Auth::id()){
                $reply = new Reply();

                $reply->name = Auth::user()->name;
                $reply->user_id = Auth::user()->id;
                $reply->comment_id=$request->commentId;
                $reply->reply=$request->reply;
                $reply->save();

                return redirect()->back();
             }else{
                return redirect('login');
             }
    }

    public function productSearch(Request $request){
         $search_text = $request->search;
        $comment = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();
        $product = Product::where('title','LIKE', "%$search_text%")->orWhere('category', 'LIKE', "%$search_text%")->paginate(10);

        return view('home.index',compact('product','comment','reply'));
    }


    public function allProduct(){

        $product = Product::paginate(10);

        $comment = Comment::orderby('id', 'desc')->get();
        $reply = Reply::all();

        return view('home.all_product',compact('product','comment','reply'));
    }
}
