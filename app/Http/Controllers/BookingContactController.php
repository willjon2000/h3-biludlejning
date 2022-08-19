<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use App\Models\Contact;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingContactController extends Controller
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

        $bookingscontactsPerPagination = 10;

        $contact = Contact::paginate($bookingscontactsPerPagination);

        return view('contact.index')
            ->with('contact',$contact);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        if(!Auth::check())
            return redirect()->intended('login');

        return view('contact.view')->with('contact',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        if(!Auth::check())
            return redirect()->intended('login');


        return view('contact.view')->with('contact',$id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        if(!Auth::check())
            return redirect()->intended('login');

        $contact = Contact::find($id);
        if(!$contact){
            redirect()->route('contact.index');
        }

        $attr = $this->validate( $request,[
            'fullname' => 'required|string|max:255',
            'email' => 'required|String|max:255',
            'phone' => 'required|int|digits:8'
        ]);

        $indput = $request->all();
        $contact->update($indput);

        return redirect()->route('contact.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        if(!Auth::check())
            return redirect()->intended('login');

        $contact = Contact::find($id);
        if(!$contact)
            redirect()->route('contact.index');

        //Deletes a line in the specified point in the table.
        $contact->delete();

        return redirect()->route('contact.index');
    }
}
