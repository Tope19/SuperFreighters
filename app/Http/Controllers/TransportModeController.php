<?php

namespace App\Http\Controllers;

use App\TransportMode;
use Exception;
use Illuminate\Http\Request;

class TransportModeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modes = TransportMode::get();
        return view('admin.transport_mode.view', compact('modes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.transport_mode.add');
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
        TransportMode::create($data);
        // toastr()->success('Transport Mode added successfully!');
        return redirect()->route('admin.transportMode.index');
    }

    private function validateData(Request $request){
        $data = $request->validate([
            'name' => 'required|string',
            'base_fare' => 'required|string',
            'price_per_kg' => 'required|string',
        ]);

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TransportMode  $transportMode
     * @return \Illuminate\Http\Response
     */
    public function show(TransportMode $transportMode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TransportMode  $transportMode
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modes = TransportMode::findorfail($id);
        return view('admin.transport_mode.edit',compact('modes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TransportMode  $transportMode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mode = TransportMode::findorfail($id);
        if (empty($mode)) {
            // toastr()->error('Item not found!');
            return redirect()->route('admin.transportMode.index');
        }
        $data = $this->validateData($request, 'nullable');
        $mode->update($data);
        // toastr()->success('Transport Mode updated successfully!');
        return redirect()->route('admin.transportMode.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TransportMode  $transportMode
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mode = TransportMode::findorfail($id);
        $mode->delete();
        // toastr()->success('Transport Mode deleted successfully!');
        return redirect()->back();
    }
}
