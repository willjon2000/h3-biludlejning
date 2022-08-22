<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use App\Models\AddonRelation;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
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

        $bookingPerPagination = 10;
        $booking = Booking::paginate($bookingPerPagination);

        return view('booking.index')
            ->with('booking',$booking);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('booking.create')
            ->with('vehicle',Vehicle::all())
            ->with('addon',Addon::all());
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

        $this->validate($request, [
            'vehicle_id' => "required|int",
            'fullname' => "required|string|max:255",
            'email' => "required|string|max:255",
            'phone' => "required|string|max:8",
            'start_timestamp' => "required|date",
            'end_timestamp' => "date|after_or_equal:".Carbon::today()->startOfDay()
        ]);

        $vehicle = Vehicle::where('id',$request["vehicle_id"])->first();
        if (empty($vehicle)) {
            return redirect()->back()->withInput()->withErrors(['could not find get the vehicle']);
        };

        $booking = new Booking();
        $booking->vehicle()->associate($vehicle);

        $contact = Contact::where('email',$request['email'])->orWhere('phone',$request['phone'])->first();
        if (empty($contact)){
            $contact = new Contact();
            $contact->fill(['fullname' => $request["fullname"], 'email' => $request["email"], 'phone' => $request["phone"]]);
            $contact->save();
        }
        $booking->contact()->associate($contact);

        $booking->start_timestamp = Carbon::parseFromLocale($request["start_timestamp"])->format('Y-m-d H:i:s');
        $booking->end_timestamp = Carbon::parseFromLocale($request["end_timestamp"])->format('Y-m-d H:i:s');
        $booking->save();


        if(!empty($request['addons'])) {
            //  $addonArr = [];
            foreach ($request['addons'] as $id) {

                $addon = Addon::find($id);
                //array_push($addonArr,$addon);*/
                //$addonRelation->booking()->associate($booking);
                $booking->addons()->attach($addon);
                //$addonRelation->save();
            }
        }

        return redirect()->route('booking.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Auth::check())
            return redirect()->intended('login');

        $booking = Booking::find($id);
        if (empty($booking)){
            redirect()->route('booking.index');
        }
       return view('booking.view')
           ->with('booking',$booking)
           ->with('vehicle',Vehicle::all())
           ->with('addon',Addon::all())
           ->with('contact',Contact::all());
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
        $booking = Booking::find($id);
        if (empty($booking)){
            redirect()->route('booking.index');
        }

        return view('booking.edit')
            ->with('booking',$booking)
            ->with('addon',Addon::all())
            ->with('vehicle',Vehicle::all())
            ->with('contact',Contact::all());
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

        $this->validate($request, [
            'vehicle_id' => "required|int",
            'fullname' => "required|string|max:255",
            'email' => "required|string|max:255",
            'phone' => "required|int|max:8",
            'start_timestamp' => "required|date|",
            'end_timestamp' => "date|after_or_equal:".Carbon::today()->startOfDay()
        ]);

        $vehicle = Vehicle::where('id',$request["vehicle_id"])->first();
        if (empty($vehicle)) {
            return redirect()->back()->withInput()->withErrors(['could not find get the vehicle']);
        };

        $booking = new Booking();
        $booking->vehicle()->associate($vehicle);

        /*$bookingAddons = $booking->addons();
        foreach ($request["addons[]"] as id) {
            $addon = Addon::find($id);
            array_search($addon, $bookingAddons);
        }*/

        $booking->start_timestamp = Carbon::parseFromLocale($request["start_timestamp"])->format('Y-m-d H:i:s');
        $booking->end_timestamp = Carbon::parseFromLocale($request["end_timestamp"])->format('Y-m-d H:i:s');
        $booking->update();

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
        $booking = Booking::find($id);
        if (empty($booking)){
            redirect()->route('booking.index');
        }
        $booking->delete();

        redirect()->route('booking.index');
    }
}
