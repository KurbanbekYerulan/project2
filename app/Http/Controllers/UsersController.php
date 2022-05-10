<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\User;
class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.users.index')->with('users',User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    public function admin($id){
        $user = User::find($id);
        $user->admin = 1;
        $user->save();
        session()->flash('success','Successfully changed user permissions !');
        return redirect()->route('users');
    }
    public function not_admin($id){
        $user = User::find($id);
        $user->admin = 0;
        $user->save();
        session()->flash('success','Successfully changed user permissions !');
        return redirect()->route('users');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required',
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=> bcrypt($request->password)
        ]);
        $profile = Profile::create([
            'user_id'=> $user->id,
            'avataro'=>'uploads/avatars/img.png',
            'about'=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores autem consectetur itaque numquam omnis qui quis quos, tenetur? Ab ad aliquam consequatur doloremque earum eligendi esse impedit quae, ullam veritatis.',
            'facebook'=>'facebook.com',
            'youtube'=>'youtube.com'
        ]);
        session()->flash('success','User created successfully!');
        return redirect()->route('users');
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
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        $user = User::find($id);
        $user->profile->delete();
        User::destroy($id);

        session()->flash('success','User deleted successfully!');
        return redirect()->route('users');
    }

}
