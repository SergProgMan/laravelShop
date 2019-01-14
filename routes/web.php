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

Route::get('/', 'HomeController@index')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/category/{category}', 'HomeController@showCategory')->name('category.show');
Route::get('/{product}', 'HomeController@showProduct')->name('product.show')->prefix('{category}');

Route::middleware('auth')->group(function(){
    //Route::get('/userProfile/{userProfile}', 'UserProfileController@show')->name('userProfile.show');
    Route::get('/userProfile', 'UserProfileController@show')->name('userProfile.show');
    Route::get('/userProfile/{userProfile}/edit', 'UserProfileController@edit')->name('userProfile.edit');
    Route::post('/userProfile/store', 'UserProfileController@store')->name('userProfile.store');
});


Route::middleware(['auth','isAdmin'])->namespace('BackOffice')->prefix('backOffice')->name('backOffice.')->group(function(){ //create group of routs
    Route::resource('/products','ProductsController');
    Route::resource('/categories', 'CategoriesController');
});