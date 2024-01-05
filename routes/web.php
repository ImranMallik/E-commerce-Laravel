<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,'index']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect',[HomeController::class,'redirect'])->middleware('auth', 'verified')->name('index');

// Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');

Route::get('/category',[AdminController::class,'category'])->name('admin.category');

Route::post('/careate/category',[AdminController::class,'create'])->name('create.category');

Route::get('/category/delete/{id}',[AdminController::class,'delete'])->name('category.delete');

Route::get('/products',[AdminController::class,'product'])->name('product');
Route::post('/add_product',[AdminController::class,'add_product'])->name('addproduct');

Route::get('/show_product',[AdminController::class,'show_product'])->name('showproduct');
Route::get('/delete_product/{id}',[AdminController::class,'delete_product'])->name('delete.product');
Route::get('/product_update/{id}',[AdminController::class,'product_update'])->name('product.update');
Route::post('/product_upload/{id}',[AdminController::class,'product_upload'])->name('product_upload');
Route::get('/product_deatails/{id}',[HomeController::class, 'product_deatails'])->name('product.deatails');
Route::post('/add_cart/{id}',[HomeController::class, 'add_cart'])->name('add.cart');
Route::get('/cart_show',[HomeController::class,'cartShow'])->name('show.cart');
Route::get('/remove_cart/{id}',[HomeController::class,'removeCart'])->name('remove.cart');

Route::get('/cash_order',[HomeController::class,'cashorder'])->name('cash.order');

Route::get('/stripe_product/{totalprice}',[HomeController::class,'stripe'])->name('srtipe.product');

Route::post('/stripe/{totalprice}',[HomeController::class,'stripePost'])->name('stripe.post');

Route::get('/order',[AdminController::class,'order'])->name('admin.order');

Route::get('/delivered/{id}',[AdminController::class,'delivered'])->name('order.delivered');

Route::get('/payment',[AdminController::class,'Payment'])->name('order.payment');

Route::get('/send_email/{id}',[AdminController::class,'send_email'])->name('send_email');
Route::post('/send_user_email/{id}',[AdminController::class,'sendUserEmail'])->name('send_user_email');

Route::get('/order_search',[AdminController::class,'orderSearch'])->name('search_order');

Route::get('/order_show',[HomeController::class,'showOrder'])->name('show_order');
Route::get('/order_cancel/{id}',[HomeController::class,'cancelOrder'])->name('cancel_order');

Route::post('/comment',[HomeController::class,'addComment'])->name('add_comment');
Route::post('/reply_add',[HomeController::class,'addReply'])->name('add_reply');

Route::get('/product_search',[HomeController::class,'productSearch'])->name('product_search');

Route::get('/all_Products',[HomeController::class,'allProduct'])->name('all.product');