@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <th>
                    Image
                </th>
                <th>
                    Name
                </th>
                <th>
                    Permission
                </th>
                <th>
                    Edit profile
                </th>
                <th>
                    Delete
                </th>
                </thead>
                <tbody>
                @if($users->count() > 0)
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <img src="{{asset($user->profile->avataro)}}" alt="" width="150px" height="200px" style="border-radius: 50%  ">
                            </td>
                            <td>
                                {{$user->name}}
                            </td>
                            <td>
                                @if($user->admin)
                                    <a href= "{{route('user.not_admin',['id'=>$user->id])}}" class="btn btn-xs btn-danger">Remove admin permission</a>
                                @else
                                    <a href= "{{route('user.admin',['id'=>$user->id])}}" class="btn btn-xs btn-success">Make admin</a>
                                @endif
                            </td>
                            <td>
                                <a href= "{{route('user.profile',['id'=>$user->id])}}" class="btn btn-xs">Edit profile</a>
                            </td>
                            <td>
                                <a href="{{route('user.delete',['id'=>$user->id])}}" class="btn btn-xs ">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th colspan="5" class="text-center">
                            There are no users!
                        </th>
                    </tr>
                @endif
                </tbody>
            </table>

        </div>
    </div>
@stop

