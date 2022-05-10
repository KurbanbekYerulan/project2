<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
class   TagController extends Controller
{

    public function index()
    {
        return view('admin.Tag.index')->with('tags',Tag::all());
    }


    public function create()
    {
        return view('admin.Tag.create');
    }


    public function store(Request $request)
    {
        $this->validate( $request,[
            'tag' => 'required'
        ]);
        Tag::create([
            'tag' => $request->tag
        ]);

        session()->flash('success','Tag created successfully!');
        return redirect()->back();
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('admin.Tag.edit')->with('tag',$tag);
    }

    public function update(Request $request, $id)
    {
        $this->validate( $request,[
            'tag' => 'required'
        ]);
        $tag = Tag::find($id);
        $tag->tag = $request->tag;
        $tag->save();
        session()->flash('success','Tag updated successfully!');
        return redirect()->route('tags');
    }

    public function destroy($id)
    {
        Tag::destroy($id);
        session()->flash('success','Tag deleted successfully!');
        return redirect()->route('tags');
    }
}
