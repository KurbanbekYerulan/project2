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
            Update tag {{$tag->tag}}
        </div>
        <div class="card-body">
            <form action="{{route('tag.update',['id'=>$tag->id])}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="tag">Tag</label>
                    <input type="text" name="tag" value="{{$tag->tag }}" class="form-control">
                </div>
                <div class="form-group">
                    <div class="text-center">

                        <button class="btn btn-succes" type="submit">
                            Update tag
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
