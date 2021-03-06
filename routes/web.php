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

Route::resource('/', 'IndexController');

Route::get('index', ['as'=>'index','uses'=>'IndexController@index']);

Route::resource('user', 'UserController');

Route::resource('role', 'RoleController');

Route::resource('service', 'ServiceController');

Route::get('login', ['as'=>'login.index','uses'=>'Auth\LoginController@index']);

Route::get('logout', ['as'=>'login.index','uses'=>'Auth\LoginController@logout']);

Route::post('login', ['as'=>'login.process','uses'=>'Auth\LoginController@process']);

Route::post('refresh', ['as'=>'login.refresh','uses'=>'Auth\LoginController@refresh']);

Route::get('record', ['as'=>'record.index','uses'=>'RecordController@index']);

// msg

Route::resource('msg', 'MsgController');

Route::get('msg_clone', ['as'=>'msg.clone','uses'=>'MsgController@clone']);

// product

Route::resource('product', 'ProductController');

Route::post('get_product_spec', ['as'=>'product.get_product_spec','uses'=>'ProductController@get_product_spec']);

// purchase

Route::resource('purchase', 'PurchaseController');

Route::post('purchase_verify', ['as'=>'purchase.purchase_verify','uses'=>'PurchaseController@verify']);

// stock

Route::get('stock_batch_list', ['as'=>'stock.stock_batch_list','uses'=>'StockController@stock_batch_list']);

Route::get('stock_total_list', ['as'=>'stock.stock_total_list','uses'=>'StockController@stock_total_list']);

Route::get('immediate_stock_list', ['as'=>'stock.immediate_stock_list','uses'=>'StockController@immediate_stock_list']);

Route::get('lack_of_stock_list', ['as'=>'stock.lack_of_stock_list','uses'=>'StockController@lack_of_stock_list']);

// order

Route::resource('order', 'OrderController');

Route::post('order_verify', ['as'=>'order.order_verify','uses'=>'OrderController@verify']);

// upload

Route::get('product_upload', ['as'=>'upload.product_upload','uses'=>'UploadController@product_upload']);

Route::post('product_upload_process', ['as'=>'upload.product_upload_process','uses'=>'UploadController@product_upload_process']);

Route::get('product_upload_format_download', ['as'=>'upload.product_upload_format_download','uses'=>'UploadController@product_upload_format_download']);

Route::get('product_spec_upload', ['as'=>'upload.product_spec_upload','uses'=>'UploadController@product_spec_upload']);

Route::post('product_spec_upload_process', ['as'=>'upload.product_spec_upload_process','uses'=>'UploadController@product_spec_upload_process']);

Route::get('product_spec_upload_format_download', ['as'=>'upload.product_spec_upload_format_download','uses'=>'UploadController@product_spec_upload_format_download']);

Route::get('purchase_upload', ['as'=>'upload.purchase_upload','uses'=>'UploadController@purchase_upload']);

Route::post('purchase_upload_process', ['as'=>'upload.purchase_upload_process','uses'=>'UploadController@purchase_upload_process']);

Route::get('purchase_upload_format_download', ['as'=>'upload.purchase_upload_format_download','uses'=>'UploadController@purchase_upload_format_download']);

Route::get('order_upload', ['as'=>'upload.order_upload','uses'=>'UploadController@order_upload']);

Route::post('order_upload_process', ['as'=>'upload.order_upload_process','uses'=>'UploadController@order_upload_process']);

Route::get('order_upload_format_download', ['as'=>'upload.order_upload_format_download','uses'=>'UploadController@order_upload_format_download']);

