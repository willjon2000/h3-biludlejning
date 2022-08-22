<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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

        $userPerPagination = 10;

        $user = User::paginate($userPerPagination);

        return view('user.index')
            ->with('user',$user);
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

        return view('user.create');
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

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'emial' => 'required|string|max:255',
            'password' => 'required|string|max:255'
        ]);
        $search = User::where('email','=',$request->email)->first();
        if(!empty($search)){
            return redirect()->back()->withInput()->withErrors(['Your email exists allready login instead']);
        }
        $input = $request->all();
        $user = new User();
        $user->fill($input)->save();

        return redirect()->route('user.index');
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

        $user = User::find($id);
        if(!$user)
            redirect()->route('user.index');

        return view('user.view')->with('user',$id);
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

        $user = User::find($id);
        if(!$user)
            redirect()->route('user.index');

        return view('user.edit')->with('user',$user);

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

        $user = User::find($id);
        if(!$user)
            redirect()->route('user.index');

        $attr = $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255'
        ]);

        $input = $request->all();
        $user->update($input);

        return redirect()->route('user.index');
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

        $user = User::find($id);
        if(!$user)
            redirect()->route('user.index');

        //Deletes a line in the specified point in the table.
        $user->delete();

        return redirect()->route('user.index');
    }
}
