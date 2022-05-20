<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Tag;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index(){
        return view('welcome')
            ->with('title',Setting::first()->site_name)
            ->with('categories',Category::take(5)->get())
            ->with('first_post', Post::orderBy('created_at','desc')->first())
            ->with('second_post', Post::orderBy('created_at','desc')->skip(1)->take(1)->get()->first())
            ->with('third_post', Post::orderBy('created_at','desc')->skip(2)->take(1)->get()->first())
            ->with('career',Category::find(3))
            ->with('tutorials',Category::find(2))
            ->with('settings',Setting::first());
    }

    public function singlePost($slug){
        $post = Post::where('slug',$slug)->first();
        $next_ID = Post::where('id','>',$post->id)->min('id');
        $previous_ID = Post::where('id','<',$post->id)->max('id');
        return view('admin.posts.single')->with('post',$post)
            ->with('title',$post->title)
            ->with('settings',Setting::first())
            ->with('categories',Category::take(5)->get())
            ->with('next', Post::find($next_ID))
            ->with('previous', Post::find($previous_ID))
            ->with('tags',Tag::all());

    }
    public function category($id){
        $category = Category::find($id);

        return view('category')->with('category',$category)
            ->with('title',$category->name)
            ->with('settings',Setting::first())
            ->with('categories',Category::take(5)->get())
            ->with('tags',Tag::all());
    }
    public function tag($id){
        $tag = Tag::find($id);

        return view('tag')->with('tag',$tag)
            ->with('title',$tag->tag)
            ->with('categories',Category::take(5)->get())
            ->with('tags',Tag::all());

    }
}
