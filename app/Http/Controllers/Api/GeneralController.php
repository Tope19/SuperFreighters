<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Country;
use App\Route;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function getCountryRoutes($id)
    {
        $data = Route::where("country_id" , $id)->orderby('name')->get();
        return response()->json( $data );
    }
}
