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
            Edit the user profile
        </div>
        <div class="card-body">
            <form action="{{route('profile.update',['id'=>$user->id])}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">User name</label>
                    <input type="text" name="name" value="{{$user->name}}" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{$user->email}}" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <label for="password">New password</label>
                    <input type="password" name="password"  value="{{$user->password}}" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <label for="avataro">Upload a new Avatar</label>
                    <input type="file" name="avataro" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <label for="about">About</label>
                    <textarea name="about" id="about" cols="95" rows="6">{{$user->profile->about}}</textarea>
                </div>
                <br>
                <div class="form-group">
                    <label for="facebook">Facebook profile</label>
                    <input type="text" name="facebook" value="{{$user->profile->facebook}}" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <label for="youtube">Youtube profile</label>
                    <input type="text" name="youtube" value="{{$user->profile->youtube}}" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">Update user profile </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

