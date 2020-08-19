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
//Products routes
Route::get('/product', [
    'uses' => 'ProductsController@index',
    'as' => 'product.index'
]);
Route::get('/product/create', [
    'uses' => 'ProductsController@create',
    'as' => 'product.create'
]);

Route::post('/product/store', [
    'uses' => 'ProductsController@store',
    'as' => 'product.store'
]);


Route::any('/product/edit/{id?}', [
    'uses' => 'ProductsController@edit',
    'as' => 'product.edit'
]);

Route::post('/product/add_variation_block', [
    'uses' => 'ProductsController@add_variation_block',
    'as' => 'product.addVariationBlock'
]);

Route::get('/product/delete/{id}', [
    'uses' => 'ProductsController@delete',
    'as' => 'product.delete'
]);


Route::post('/product/delete_variation', [
    'uses' => 'ProductsController@delete_variation',
    'as' => 'product.delete_variation'
]);


//Categories routes
Route::get('/category/search/{term?}/{page?}', [
    'uses' => 'CategoriesController@search',
    'as' => 'category.search'
]);

//Attributes routes
Route::get('/attribute', [
    'uses' => 'AttributesController@index',
    'as' => 'attribute.index'
]);
Route::get('/attribute/create', [
    'uses' => 'AttributesController@create',
    'as' => 'attribute.create'
]);

Route::post('/attribute/store', [
    'uses' => 'AttributesController@store',
    'as' => 'attribute.store'
]);

Route::any('/attribute/edit/{id?}', [
    'uses' => 'AttributesController@edit',
    'as' => 'attribute.edit'
]);

Route::get('/attribute/search/{term?}/{page?}', [
    'uses' => 'AttributesController@search',
    'as' => 'attribute.search'
]);
