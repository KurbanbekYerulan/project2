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
                    Title
                </th>
                <th>
                    Edit
                </th>
                <th>
                    Restore
                </th>
                <th>
                    Delete
                </th>
                </thead>
                <tbody>
                @if($posts->count() > 0)
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                <img src="{{asset($post->fetured)}}" alt=" {{$post->title}}" width="150px" height="200px">
                            </td>
                            <td>
                                {{$post->title}}
                            </td>
                            <td>
                                <a href="{{route('post.edit',['id'=>$post->id])}}" class="btn btn-xs btn-info">
                                    Edit
                                </a>
                            </td>
                            <td>
                                <a href="{{route('post.restore',['id'=>$post->id])}}" class="btn btn-xs btn-success">
                                    Restore
                                </a>
                            </td>
                            <td>
                                <a href="{{route('post.kill',['id'=>$post->id])}}" class="btn btn-xs btn-danger">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th colspan="5" class="text-center">
                            No trashed posts!
                        </th>
                    </tr>
                @endif
                </tbody>
            </table>

        </div>
    </div>
@stop


