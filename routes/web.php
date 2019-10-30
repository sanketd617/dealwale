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

Route::group(['middleware' => ['redirect']], function () {
    Route::get('/', function () { return view('index'); });
//    Route::get('/test', 'CrawlerController@crawl');
    Route::get('/logout', 'AuthController@logout')->name('get.logout');
    Route::get('/search', 'SearchController@search')->name('get.search');
    Route::get('/wishlist', function () { return view('wishlist'); })->name('get.wishlist');
    Route::post('/wish', 'WishlistController@wish')->name('post.wish');
    Route::post('/unwish', 'WishlistController@unwish')->name('post.unwish');
});



Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', function () { return view('login'); })->name('get.login');
    Route::post('/login', 'AuthController@authenticate')->name('post.login');
});
