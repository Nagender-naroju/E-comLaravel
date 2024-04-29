<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\frontend\FrontController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\ReviewsController;

Route::get('/', [FrontController::class,'index']);
Route::get('/categories', [FrontController::class,'fetch_categories']);
Route::get('/view-category/{slug}', [FrontController::class,'view_categories']);
Route::get('/view-product/{id}', [FrontController::class,'view_product']);
Route::post('/search-product', [FrontController::class,'search_product']);
Route::get('/get-products', [FrontController::class,'get_products']);
Route::post('/add-cart', [CartController::class, 'add_to_cart']);
Route::post('/remove-item', [CartController::class, 'remove_cart_item']);
Route::post('/update-cart', [CartController::class, 'cart_update']);

Route::middleware(['auth'])->group(function(){
    Route::get('/view-cart', [CartController::class, 'cart_list']); 
    Route::get('/checkout', [CheckoutController::class, 'index']);  
    Route::post('/place-order', [CheckoutController::class, 'place_order']);  
    Route::get('/my-orders', [CheckoutController::class, 'my_orders']);  
    Route::get('/view-orders/{id}', [CheckoutController::class, 'view_orders']);  
    Route::post('/add-wishlist', [FrontController::class, 'add_wishlist']);  
    Route::get('/get-wishlist', [FrontController::class, 'wishlist_page']);  
    Route::get('/wishlists', [FrontController::class, 'get_wishlists']);  
    Route::get('/wishlists-count', [FrontController::class, 'get_wishlist_count']);  
    Route::get('/cart-count', [FrontController::class, 'get_cart_count']);  
    Route::post('/proceed-pay', [CheckoutController::class, 'razorpay_payment']);  
    Route::post('/save-review', [ReviewsController::class, 'save_reviews']);  
    Route::post('/reviews', [ReviewsController::class, 'get_reviews']);  
    Route::post('/update-review', [ReviewsController::class, 'update_review']);  
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function(){
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard']);
    Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'categories']);
    Route::get('/add-category', [App\Http\Controllers\Admin\CategoryController::class, 'create_category']);
    Route::POST('/save-category', [App\Http\Controllers\Admin\CategoryController::class, 'store_category']);
    Route::get('/get_categoryId/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'get_categoryId']);
    Route::post('/update_category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update_category']);
    Route::get('/delete-category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'delete_category']);

    // products
    
    Route::get('/products', [ProductsController::class, 'products_list']);
    Route::get('/add-products', [ProductsController::class, 'add_product']);
    Route::post('/save-products', [ProductsController::class, 'store_product']);
});
