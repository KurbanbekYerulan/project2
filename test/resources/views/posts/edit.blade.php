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
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control">
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

