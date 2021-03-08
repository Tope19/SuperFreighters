<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
   }

    public function logout(){
        Session::flush();
        return redirect()->route('index');
    }
}
