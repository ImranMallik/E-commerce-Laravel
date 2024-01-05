<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\MyNotification;
use Illuminate\Notifications\Notification;
use PDF;

class AdminController extends Controller
{
  //

  // public function dashboard(){
  //   return view('admin.index');
  // }

  public function category()
  {
    $categories = category::all();
    return view('admin.category', compact('categories'));
  }

  public function create(Request $request)
  {
    $category = new Category;

    $category->category_name = $request->name;

    $category->save();

    return redirect()->back()->with('message', 'Category Created Successfully');
  }

  public function delete($id)
  {
    $category = Category::findOrFail($id);
    $category->delete();

    return redirect()->back()->with('message', 'Category Delete Successfully');
  }

  public function product()
  {
    $category = category::all();
    return view('admin.product', compact('category'));
  }

  public function add_product(Request $request)
  {
    $product = new Product;

    $product->title = $request->title;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->quantity = $request->quantity;
    $product->discount_price = $request->discount;
    $product->category = $request->category;

    $image = $request->image;
    $imageName = time() . '.' . $image->getClientOriginalExtension();

    $request->image->move('product', $imageName);
    $product->image = $imageName;

    $product->save();

    return redirect()->back()->with('message', 'Product Add Successfully');
  }

  public function show_product()
  {
    $product = Product::all();
    return view('admin.showproduct', compact('product'));
  }

  public function delete_product($id)
  {
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->back()->with('message', 'Product Deleted Successfully');
  }

  public function product_update($id){
    $product = Product::findOrFail($id);
    $category = category::all();
    return view('admin.edit-product',compact('product','category'));
  }

  public function product_upload(Request $request,$id){
    $product = Product::findOrFail($id);
    
    $product->title = $request->title;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->quantity = $request->quantity;
    $product->discount_price = $request->discount;
    $product->category = $request->category;

    $image = $request->image;
    if($image){
      
      $imageName = time() . '.' . $image->getClientOriginalExtension();
      $request->image->move('product', $imageName);
      $product->image = $imageName;
    }
    $product->save();
    return redirect()->route('showproduct')->with('message', 'Product Update Successfully');
  }
     
  public function order(){
    $order = Order::all();
    return view('admin.order',compact('order'));
  }

  public function delivered($id){
     $orderId = Order::findOrFail($id);
     $orderId->delivery_status = "Delivered";
     $orderId->payment_status = "paid";
     $orderId->save();

     return redirect()->back();
  }

  public function send_email($id){
    $order= Order::findOrFail($id);
    return view('admin.email_info',compact('order'));
  }
  
  public function sendUserEmail(Request $request,$id){
    $order = Order::findOrFail($id);

    $details = [
      'greeting' => $request->greeting,
      'firstline' => $request->firstline,
      'body' => $request->body,
      'button' => $request->button,
      'url' => $request->url,
      'lastline' => $request->lastline

    ];
    Notification::send($order,new MyNotification($details));
    return redirect()->back();
  }

  public function orderSearch(Request $request){

    $searchText = $request->search;
    $order = Order::where('name','LIKE',"%$searchText%")->orWhere('phone','LIKE',"%$searchText%")->orWhere('product_title','LIKE',"%$searchText%")->get();
    return view('admin.order',compact('order'));
  }

  
}
