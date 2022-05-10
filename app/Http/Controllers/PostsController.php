<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use MongoDB\Driver\Session;
use Illuminate\Support\Str;
class PostsController extends Controller
{

    public function index()
    {

    }

    public function list(){
        return view('admin.posts.list')->with('posts',Post::all());
    }
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        if($categories->count()==0){
            session()->flash('info','You must create a new categories!');
            return view('admin.categories.create');
        }
        if ($tags->count()==0){
            session()->flash('info','You must create a new tags!');
            return view('admin.Tag.create');
        }
        return view('admin.posts.create')->with('categories',Category::all())->with('tags',Tag::all());
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'fetured'=>'required|mimes:jpeg,jpg,png,gif',
            'contents'=>'required',
            'category_id'=>'required',
            'tags' => 'required'
        ]);
        $featured = $request->fetured;
        $filename = time().$featured->getClientOriginalExtension();
        $featured->move('uploads/posts',$filename  );

        $post = Post::create([
            'title' => $request->title,
            'fetured'=>'uploads/posts/' . $filename,
            'contents'=> $request->contents,
            'category_id' => $request->category_id,
            'slug'=> str_slug($request->title)
        ]);
        $post->tags()->attach($request->tags);
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $post = Post::find($id);
        return view('admin.posts.edit')->with('post',$post)->with('categories',Category::all())->with('tags',Tag::all());
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,   [
            'title'=>'required',
            'contents'=>'required',
            'category_id'=>'required'
        ]);
        $post = Post::find($id);
        if ($request->hasFile('fetured'))
        {
            $featured = $request->fetured;
            $filename = time().$featured->getClientOriginalExtension();
            $featured->move('uploads/posts',$filename);
            $post->fetured = 'uploads/posts/'.$filename;
        }
        $post->title = $request->title;
        $post->contents = $request->contents;
        $post->category_id = $request->category_id;
        $post->save();
        $post->tags()->sync($request->tags);
        session()->flash('success','You succesfully updated the post');
        return redirect()->route('posts');
    }


    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete();
        session()->flash('success','You succesfully deleted the post');
        return redirect()->route('posts');
    }
    public function kill($id){
        $post = Post::withTrashed()->where('id',$id)->first();
        $post->forceDelete();
        session()->flash('success','Post deleted permanenty.');
        return redirect()->back();
    }
    public function trashed(){
        $posts = Post::onlyTrashed()->get();
        return view('admin.posts.trashed')->with('posts',$posts);
    }
    public function restore($id){
        $post = Post::withTrashed()->where('id',$id)->first();
        $post->restore();
        session()->flash('success','Post restored succesfully.');
        return redirect()->route('posts');
    }
}
