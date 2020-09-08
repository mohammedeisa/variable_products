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

Route::get('/', function () {
    return view('welcome');
});
//Products routes/////////////////////////////////////////////////////////////////////
Route::get('/product', [
    'uses' => 'backend\ProductsController@index',
    'as' => 'product.index'
]);
Route::get('/product/create', [
    'uses' => 'backend\ProductsController@create',
    'as' => 'product.create'
]);

Route::post('/product/store', [
    'uses' => 'backend\ProductsController@store',
    'as' => 'product.store'
]);


Route::any('/product/edit/{id?}', [
    'uses' => 'backend\ProductsController@edit',
    'as' => 'product.edit'
]);

Route::post('/product/add_variation_block', [
    'uses' => 'backend\ProductsController@add_variation_block',
    'as' => 'product.addVariationBlock'
]);

Route::get('/product/delete/{id}', [
    'uses' => 'backend\ProductsController@delete',
    'as' => 'product.delete'
]);


Route::post('/product/delete_variation', [
    'uses' => 'backend\ProductsController@delete_variation',
    'as' => 'product.delete_variation'
]);

//Frontend routes/////////////////////////////////////////////////////////////////////
Route::get('/products', [
    'uses' => 'frontend\ProductsController@list',
    'as' => 'product.list'
]);


Route::get('/product/{id}', [
    'uses' => 'frontend\ProductsController@show',
    'as' => 'product.show'
]);

Route::get('get_product_JSON/{id}', [
    'uses' => 'frontend\ProductsController@get_product_JSON',
    'as' => 'product.get_product_JSON'
]);

Route::get('products/filter', [
    'uses' => 'frontend\ProductsController@filter',
    'as' => 'product.filter'
]);

Route::get('/products/search/', [
    'uses' => 'frontend\ProductsController@search',
    'as' => 'product.search'
]);


Route::get('/products/sort_by_category/', [
    'uses' => 'frontend\ProductsController@sort_by_category',
    'as' => 'product.sort_by_category'
]);
//Orders routes/////////////////////////////////////////////////////////////////////
Route::post('/orders/place_an_order/', [
    'uses' => 'frontend\OrdersController@place_an_order',
    'as' => 'order.place_an_order'
]);
//Categories routes/////////////////////////////////////////////////////////////////////
Route::get('/category/search/{term?}/{page?}', [
    'uses' => 'backend\CategoriesController@search',
    'as' => 'category.search'
]);

//Attributes routes/////////////////////////////////////////////////////////////////////
Route::get('/attribute', [
    'uses' => 'backend\AttributesController@index',
    'as' => 'attribute.index'
]);
Route::get('/attribute/create', [
    'uses' => 'backend\AttributesController@create',
    'as' => 'attribute.create'
]);

Route::post('/attribute/store', [
    'uses' => 'backend\AttributesController@store',
    'as' => 'attribute.store'
]);

Route::any('/attribute/edit/{id?}', [
    'uses' => 'backend\AttributesController@edit',
    'as' => 'attribute.edit'
]);

Route::get('/attribute/search/{term?}/{page?}', [
    'uses' => 'backend\AttributesController@search',
    'as' => 'attribute.search'
]);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
