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
            Create a new post
        </div>
        <div class="card-body">
            <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="fetured">Featured image</label>
                    <input type="file" name="fetured" class="form-control">
                </div>
                <div class="form-group">
                    <label for="category">Select a category</label>
                    <select name="category_id" id="category " class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name  }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tags">Select the tags  </label>
                    @foreach($tags as $tag)
                        <div class="checkbox">
                            <label><input type="checkbox" name="tags[]" value="{{$tag->id}}">{{$tag->tag}}</label>
                        </div>
                    @endforeach

                </div>
                <div class="form-group">
                    <label for="contents">Content</label>
                    <textarea name="contents" id="contents" cols="5" rows="5" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">Store post</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@stop

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@stop

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#contents').summernote();
        });
    </script>
@stop
