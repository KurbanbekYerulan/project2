@extends('layouts.app')

@section('content')
    @if(count($errors)>0)
        <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="list-group-item text-danger">
                    {{$error}}
                </li>
            @endforeach
        </ul>
    @endif
    <div class="card">
        <div class="card-heading">
            Update the post
        </div>
        <div class="card-body">
            <form action="{{route('posts.update',['id'=>$post->id])}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="{{$post->title}}">
                </div>
                <div class="form-group">
                    <label for="fetured">Featured image</label>
                    <input type="file" name="fetured" class="form-control">
                </div>
                <div class="form-group">
                    <label for="category">Select a category</label>
                    <select name="category_id" id="category " class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                                    @if($post->category_id == $category->id)
                                    selected
                                @endif
                            >{{$category->name  }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tags">Select the tags</label>
                    @foreach($tags as $tag)
                        <div class="checkbox">
                            <label><input type="checkbox" name="tags[]" value="{{$tag->id}}"
                                          @foreach($post->tags as $t)
                                          @if($tag->id == $t->id)
                                          checked
                                    @endif
                                    @endforeach
                                >{{$tag->tag}}</label>
                        </div>
                    @endforeach

                </div>
                <div class="form-group">
                    <label for="contents">Content</label>
                    <textarea name="contents" id="contents" cols="5" rows="5" class="form-control">{{$post->contents}}</textarea>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">Update post</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

