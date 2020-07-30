<?php

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

Route::get('/', "FrontController@index");
Route::get('/shop', "FrontController@shop");
Route::get('/blog', "FrontController@blog");
Route::get('/contact', "FrontController@contact");
Route::get('/single_blog', "FrontController@single_blog");
Route::get('/product_detail', "FrontController@product_detail");
Route::get('/cart', "FrontController@cart");
Route::get('/check_out', "FrontController@check_out");
Route::get('/login', "LoginController@index");
Route::post('/login', "LoginController@login");


