<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingAddonController extends Controller
{
    public function __construct()
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::check())
            return redirect()->intended('login');

        $addonsPerPagination = 10;

        $addons = Addon::paginate($addonsPerPagination);

        return view('addon.index')
            ->with('addon',$addons);
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

        return view("addon.create");
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
            'type' => "required|String|max:255",
            'price' => "required|Double|digits_between:1,20"

        ]);

        $search = Addon::where('type','=',$request->type)->first();
        if(!empty($search)){
            return redirect()->back()->withInput()->withErrors(['the Addon already exists']);
        }

        //makes the addon
        $addon = new Addon();
        $addon->type = $request['type'];
        $addon->price = $request['price'];
        $addon->save();


        return redirect()->route('addon.index');
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
     * @param  Addon  $addon
     * @return \Illuminate\Http\Response
     */
    public function edit(Addon $addon)
    {
        if(!Auth::check())
            return redirect()->intended('login');

        return view('addon.edit')->with('addon', $addon);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Addon  $addon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Addon $addon)
    {
        if(!Auth::check())
            return redirect()->intended('login');

        //Validates the input compared to the database values.
        $this->validate($request, [
            'type' => "required|String|max:255",
            'price' => "required|Double|digits_between:1,20"
        ]);

        $oldtype = $addon->type;
        $oldprice = $addon->price;

        $addon->type = $request['type'];
        $addon->price = $request['price'];
        $addon->save();

        return redirect()->route('addon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Addon  $addon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Addon $addon)
    {
        if(!Auth::check())
            return redirect()->intended('login');

        //Deletes a line in the specified point in the table.
        $addon->delete();

        return redirect()->route('addon.index');
    }
}
