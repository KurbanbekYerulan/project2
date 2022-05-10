<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function create(){
        return view('admin.categories.create');
    }
    public function list(){
        return view('admin.categories.list')->with('categories',Category::all());
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required'
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect()->back()->with('success','You succesfully created a categories');
    }
    public function edit($id){
        $category = Category::find($id);
        return view('admin.categories.edit')->with('categories',$category);

    }
    public function delete($id){
        $category = Category::find($id);
        $category->delete();
        session()->flash('success','You succesfully deleted the categories');
        return redirect()->route('categories');
    }
    public function update(Request $request, $id){
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        session()->flash('success','You succesfully updated the categories');
        return redirect()->route('categories');

    }
}
