<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::check())
            return redirect()->intended('login');

        $vehiclesPerPagination = 10;

        $vehicles = Vehicle::paginate($vehiclesPerPagination);

        return view('vehicle.index')
            ->with('vehicle', $vehicles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::check())
            return redirect()->intended('login');

        return view("vehicle.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::check())
            return redirect()->intended('login');

        //Validates the input compared to the database values.
        $this->validate($request, [
            'type' => "required|string|max:255",
            'price' => "required|integer|digits_between:1,20"

        ]);

        $search = Vehicle::where('type','=',$request->type)->first();
        if(!empty($search)){
            return redirect()->back()->withInput()->withErrors(['the Vehicle already exists']);
        }

        $input = $request->all();
        $vehicle = new Vehicle();
        $vehicle->fill($input)->save();

        return redirect()->route('vehicle.index');
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
        if(!Auth::check())
            return redirect()->intended('login');
        
        $vehicle = Vehicle::find($id);
        if(!$vehicle)
            redirect()->route('vehicle.index');

        return view('vehicle.edit')->with('vehicle', $vehicle);
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
        if(!Auth::check())
            return redirect()->intended('login');
        
        $vehicle = Vehicle::find($id);
        if(!$vehicle)
            redirect()->route('vehicle.index');

        //Validates the input compared to the database values.
        $attr = $this->validate($request, [
            'type' => "required|string|max:255",
            'price' => "required|integer|digits_between:1,20"
        ]);

        $input = $request->all();
        $vehicle->update($input);

        return redirect()->route('vehicle.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::check())
            return redirect()->intended('login');

        $vehicle = Vehicle::find($id);
        if(!$vehicle)
            redirect()->route('vehicle.index');
        
        //Deletes a line in the specified point in the table.
        $vehicle->delete();

        return redirect()->route('vehicle.index');
    }
}
