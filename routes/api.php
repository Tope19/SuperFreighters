<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix("v1")->as("api.")->group(function(){


    Route::namespace('Api')->as('general.')->group(function(){
        Route::get('/get-country-routes/{id?}', 'GeneralController@getCountryRoutes')->name('country.routes');
    });
});
