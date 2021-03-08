<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Route;
use App\Country;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routes = Route::get();
        return view('admin.routes.view', compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get();
        return view('admin.routes.add', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);
        Route::create($data);
        return redirect()->route('admin.routes.index');
    }

    private function validateData(Request $request){
        $data = $request->validate([
            'country_id' => 'required',
            'name' => 'required|string',
            'flat_rate' => 'required|string',
        ]);

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $routes = Route::findorfail($id);
        return view('admin.routes.edit',compact('routes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $route = Route::findorfail($id);
        if (empty($route)) {
            // toastr()->error('Item not found!');
            return redirect()->route('admin.routes.index');
        }
        $data = $this->validateData($request, 'nullable');
        $route->update($data);
        return redirect()->route('admin.transportroute.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $route = Route::findorfail($id);
        $route->delete();
        return redirect()->back();
    }
}
