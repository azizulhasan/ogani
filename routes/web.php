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
Route::get('/view_product/{id}', "FrontController@product_detail");
Route::get('/cart', "FrontController@cart");



// cart controller 
Route::post('/addCart', 'CartController@addCart');
Route::get('/viewCart', 'CartController@viewCart');
Route::post('/updateCart', 'CartController@updateCart');
Route::get('/check_out', "CartController@check_out");
Route::post('/placeOrder', "CartController@placeOrder");
// Route::get('/get_pdf', "CartController@get_pdf");
Route::resource('/carts', "CartController");


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=> 'dashboard'], function(){
    Route::get('/index', "DashboardController@index");
   
    Route::get('/category-add', "DashboardController@categoryAdd");
    Route::get('/sub-category-add', "DashboardController@subCategoryAdd");
    Route::get('/attribute-add', "DashboardController@attributeAdd");
    Route::get('/order-view', "DashboardController@orderView");
    Route::get('/unit-add', "DashboardController@unitAdd");
    Route::resource('/users', "AdminController");
    Route::resource('/units', "UnitController");
    Route::resource('/attributes', "AttributeController");
    Route::resource('/categories', "CategoryController");
    Route::resource('/sub_categories', "SubCategoryController");
    Route::resource('/colors', "ColorController");
    Route::resource('/brands', "BrandController");
    Route::resource('/sizes', "SizeController");
    Route::resource('/prices', "PriceController");
    Route::resource('/discounts', "DiscountController");
    Route::get('/products/{id}/subcategory', "ProductManageController@getSubCategory");
    Route::resource('/products', "ProductManageController");
    Route::resource('/productStore', "PurchaseDetailController");
    Route::resource('/orders', "OrderController");

});


