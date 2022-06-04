<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'image'=>'required|mimes:jpeg,jpg,png,gif',
            'contents'=>'required'
        ]);
        $image = $request->image;
        $filename = time().$image->getClientOriginalExtension();
        $image->move('uploads/posts',$filename);
        $post = Post::create([
            'title' => $request->title,
            'image'=>'uploads/posts/' . $filename,
            'user_id'=> auth()->user()->id,
            'contents'=> $request->contents,
            'slug'=> str_slug($request->title),
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug',$slug)->first();
        $next_ID = Post::where('id','>',$post->id)->min('id');
        $previous_ID = Post::where('id','<',$post->id)->max('id');
        return view('posts.single')->with('post',$post)
            ->with('previous', Post::find($previous_ID))
            ->with('next', Post::find($next_ID));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit')->with('post',$post);
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
            'title'=>'required',
            'contents'=>'required',
        ]);
        $post = Post::find($id);
        if ($request->hasFile('image'))
        {
            $image = $request->image;
            $filename = time().$image->getClientOriginalExtension();
            $image->move('uploads/posts',$filename);
            $post->fetured = 'uploads/posts/'.$filename;
        }
        $post->title = $request->title;
        $post->contents = $request->contents;
        $post->save();
        return redirect()->route('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Post::destroy($id);
        return redirect()->route('posts');
    }
}
