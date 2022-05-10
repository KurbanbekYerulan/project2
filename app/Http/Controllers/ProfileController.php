<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function index($id)
    {
        $user = User::find($id);
        return view('admin.users.profile')->with('user',$user);
    }


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
    public function edit()
    {

        return view('admin.users.profile')->with('user',Auth::user());
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
        $this->validate($request,   [
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'about'=>'required',
            'facebook'=>'required',
            'youtube'=>'required'
        ]);
        $user = User::find($id);
        $profile = Profile::where('user_id',$id)->first();
        if ($request->hasFile('avataro'))
        {
            $avatar = $request->avataro;
            $filename = time().$avatar->getClientOriginalExtension();
            $avatar->move('uploads/avatars',$filename);
            $profile->fetured = 'uploads/avatars/'.$filename;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $profile->about = $request->about;
        $profile->facebook = $request->facebook;
        $profile->youtube = $request->youtube;
        $profile->save();
        session()->flash('success','You succesfully updated the user profile');
        return view('admin.home');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
