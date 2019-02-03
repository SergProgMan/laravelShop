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
Route::get('/order', 'OrdersController@create')->name('order.create');
Route::post('/order', 'OrdersController@store')->name('order.store');

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
Route::middleware(['auth','isAdmin'])->namespace('BackOffice')->prefix('backOffice')->name('backOffice.')->group(function(){ //create group of routs
    Route::resource('/products','ProductsController');
    Route::resource('/categories', 'CategoriesController');
});