<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate($request,[
            'comment'=>'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif'
        ]);


            $image = $request->image;
            $filename = time().$image->getClientOriginalExtension();
            $image->move('uploads/comments',$filename);
            Comment::create([
                'comment'=> $request->comment,
                'image' => 'uploads/comments/' . $filename,
                'user_id' => auth()->id(),
                'post_id' => $request->post_id
            ]);

        return redirect()->back();
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
        $comment = Comment::find($id);
        return view('posts.comment_edit')->with('comment',$comment);
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
        $this->validate($request,[
            'comment'=>'required',
        ]);
        $comment = Comment::find($id);
        if ($request->hasFile('image'))
        {
            $image = $request->image;
            $filename = time().$image->getClientOriginalExtension();
            $image->move('uploads/comments',$filename);
            $comment->image = 'uploads/comments/'.$filename;
        }
        $comment->comment = $request->comment;
        $comment->save();
        $post = Post::find($comment->post_id);
        return redirect()->route('single_post',['slug'=>$post->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Comment::destroy($id);
        return redirect()->back();
    }
}
