<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Frontend Route
Route::get('/', 'Frontend\FrontendController@index')->name('frontend.index');

// Cart Route
Route::post('add-to-cart/{id}', 'Frontend\CartController@addCart')->name('add.to.cart');
Route::get('product/cart', 'Frontend\CartController@Cart')->name('product.cart');
Route::get('cart/destroy/{id}', 'Frontend\CartController@destroy')->name('cart.destroy');
Route::post('cart/update/{id}', 'Frontend\CartController@update')->name('cart.update');

// Coupon Route
Route::post('coupon/apply', 'Frontend\CartController@coupon')->name('cart.coupon');
Route::get('coupon/destroy', 'Frontend\CartController@couponDestroy')->name('coupon.destroy');

// Wishlist Route
Route::get('product/wishlist/{id}', 'Frontend\WishlistController@addWishlist')->name('add.to.wishlist');
Route::get('product/wishlist', 'Frontend\WishlistController@wishlist')->name('product.wishlist');
Route::get('wishlist/delete/{id}', 'Frontend\WishlistController@destroy')->name('wishlist.destroy');

// product details
Route::get('product/{slug}', 'Frontend\CartController@productDetails')->name('product.details.show');
Route::post('product-add-cart/{id}', 'Frontend\CartController@add_to_cart')->name('product.add.to.cart');



Auth::routes();



// Admin Route
Route::group(['as'=>'admin.','prefix'=>'admin/','namespace'=>'Backend\Admin','middleware'=>['auth','admin']], function(){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    // user route
    Route::resource('user', 'UserController');
    Route::get('active/{id}', 'UserController@active')->name('user.active');
    Route::get('unactive/{id}', 'UserController@unActive')->name('user.unactive');
    // category route
    Route::resource('category', 'Category\CategoryController');
    Route::get('publish/{id}', 'Category\CategoryController@active')->name('category.active');
    Route::get('pending/{id}', 'Category\CategoryController@unActive')->name('category.unactive');
    // brand route
    Route::resource('brand', 'Brand\BrandController');
    Route::get('active-brand/{id}', 'Brand\BrandController@publish')->name('brand.publish');
    Route::get('pending-brand/{id}', 'Brand\BrandController@pending')->name('brand.pending');
    // product route
    Route::resource('product', 'Product\ProductController');
    Route::get('publish-product/{id}', 'Product\ProductController@publish')->name('product.publish');
    Route::get('pending-product/{id}', 'Product\ProductController@pending')->name('product.pending');
    // coupon
    Route::resource('coupon', 'CouponController');
    Route::get('publish-coupon/{id}', 'CouponController@publish')->name('product-coupon.publish');
    Route::get('pending-coupon/{id}', 'CouponController@pending')->name('product-coupon.pending');
    // profile
    Route::get('profile', 'Profile\ProfileController@index')->name('profile.index');
    Route::post('profile/update', 'Profile\ProfileController@update')->name('profile.store');
    Route::get('password', 'Profile\ProfileController@password')->name('password');
    Route::post('password/store', 'Profile\ProfileController@store')->name('password.store');

});

// Author Route
Route::group(['as'=>'author.','prefix'=>'author/','namespace'=>'Backend\User','middleware'=>['auth','author']], function(){

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

});


// Customer Route
Route::get('customer/registration', 'Backend\Customer\DashboardController@customerAuth')->name('customer.registration');
Route::post('customer/registration', 'Backend\Customer\DashboardController@registration')->name('customer.reg.store');
Route::get('customer/login', 'Backend\Customer\DashboardController@customerLoin')->name('customer.login');



Route::group(['as'=>'customer.','prefix'=>'customer/','namespace'=>'Backend\Customer','middleware'=>['auth','customer']], function(){

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    // checkout
    Route::get('checkout', 'CheckoutsController@checkOut')->name('checkout.index');
    Route::post('order', 'OrderController@orderStore')->name('order.store');
    Route::get('orders', 'OrderController@orderAll')->name('my.order');
    Route::get('order/view/{id}', 'OrderController@orderView')->name('order.view');

});






