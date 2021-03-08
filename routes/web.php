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

Route::match(['get', 'post'], '/', 'IndexController@index')->name('index');
Route::post('/proceed', 'IndexController@proceed')->name('proceed');
Route::match(['get', 'post'],'/payment-verify', 'IndexController@paymentVerify')->name('payment.verify');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'as' => 'admin.'],function(){
    Route::get('/dashboard',['as' => 'dashboard', 'uses' => 'AdminController@dashboard']);

    //Mode of Transport
    Route::resource('transportMode', 'TransportModeController');

    //Routes
    Route::resource('routes', 'RouteController');


});

Route::get('/logout','AdminController@logout')->name('logout');
