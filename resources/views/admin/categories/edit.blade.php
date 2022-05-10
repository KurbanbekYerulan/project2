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
            Update category {{$category->name}}
        </div>
        <div class="card-body">
            <form action="{{route('categories.update',['id'=>$category->id])}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{$category->name }}" class="form-control">
                </div>
                <div class="form-group">
                    <div class="text-center">

                        <button class="btn btn-succes" type="submit">
                            Update category
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
