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
                    Content
                </th>
                <th>
                    Edit
                </th>
                <th>
                    Move to Trash
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
                                {{$post->contents}}
                            </td>
                            <td>
                                <a href="{{route('post.edit',['id'=>$post->id])}}" class="btn btn-xs btn-info">
                                    Edit
                                </a>
                            </td>
                            <td>
                                <a href="{{route('post.delete',['id'=>$post->id])}}" class="btn btn-xs btn-danger">
                                    Trash
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th colspan="5" class="text-center">
                            There are no posts!

                        </th>
                    </tr>
                @endif
                </tbody>
            </table>

        </div>
    </div>
@stop

