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
            Edit block settings
        </div>
        <div class="card-body">
            <form action="{{route('settings.update')}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="site_name">Site name</label>
                    <input type="text" name="site_name" value="{{$settings->site_name}}" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <label for="contact_email">Contact email</label>
                    <input type="text" name="contact_email" value="{{$settings->contact_email}}" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <label for="contact_number">Phone number</label>
                    <input type="text" name="contact_number" value="{{$settings->contact_number}}" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" value="{{$settings->address}}" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">Update site settings</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

