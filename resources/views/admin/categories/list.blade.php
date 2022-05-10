@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <th>
                    Category name
                </th>
                <th>
                    Edit
                </th>
                <th>
                    Delete
                </th>
                </thead>
                <tbody>
                @if($categories->count() >0)
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                {{$category->name}}
                            </td>
                            <td>
                                <a href="{{route('categories.edit',['id'=>$category->id])}}" class="btn btn-xs btn-info">
                                    Edit
                                </a>
                            </td>
                            <td>
                                <a href="{{route('categories.delete',['id'=>$category->id])}}" class="btn btn-xs btn-danger">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th colspan="5" class="text-center">
                            There are no categories!
                        </th>
                    </tr>
                @endif
                </tbody>
            </table>

        </div>
    </div>
@stop
