<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//basic pages
Route::get('/', 'HomeController@index')->name('home');

//category pages
Route::get('/category/{id}', 'CategoriesController@show')->name('category.show');

//product pages
Route::get('/product/{id}', 'ProductsController@show')->name('product.show');

//cart routes
Route::get('/cart', 'CartController@show')->name('cart.show');
Route::post('/cart/add', 'CartController@add')->name('cart.add');
Route::post('/cart/delete', 'CartController@delete')->name('cart.delete');
Route::post('/cart/update', 'CartController@update')->name('cart.update');
 
//order routes
Route::middleware('orders_is_empty_cart')
    ->name('order.')
    ->group(function() {
        Route::get('/order', 'OrdersController@create')->name('create');
        Route::post('/order', 'OrdersController@store')->name('store');
        
    });

Route::post('/order/payment_result', 'OrdersController@paymentResult')->name('order.payment_result');
Route::post('/order/callback', 'OrdersController@callback')->name('order.callback');

Route::post('/np/search_city', 'NovaPoshtaController@searchCity')->name('np.search_city');
Route::post('/np/search_warehouse', 'NovaPoshtaController@searchWarehouse')->name('np.search_warehouse');


//user profile
Route::middleware('auth')
    ->prefix('userProfile')
    ->name('userProfile.')
    ->group(function(){
    Route::get('/', 'UserProfileController@show')->name('show');
    Route::get('edit', 'UserProfileController@edit')->name('edit');
    Route::post('update', 'UserProfileController@update')->name('update');
});

//back office
Route::middleware(['auth','isAdmin'])
    ->namespace('BackOffice')
    ->prefix('backOffice')
    ->name('backOffice.')
    ->group(function(){ //create group of routs

    Route::resource('/products','ProductsController');
    Route::resource('/categories', 'CategoriesController');

    Route::get('orders', 'OrdersController@index')->name('orders.index');
    Route::get('orders/new', 'OrdersController@new')->name('orders.new');
    Route::get('orders/{order}', 'OrdersController@show')->name('orders.show');
});

Route::get('/test', function(){
    $order = App\Order::find(7);
    //dd($order);
    return $order->online_paid_at->format('d.m.Y');
});