@extends('layouts.global')
@section('title') Category list @endsection
@section('content')
@if(session('status'))
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-warning">
            {{session('status')}}
        </div>
    </div>
</div>
@endif
<h1>Category List </h1>
<div class="row">
    <div class="col-md-6">
        <form action="{{route('categories.index')}}">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Filter by category name"
                    value="{{Request::get('name')}}" name="name">

                <div class="input-group-append">
                    <input type="submit" value="Filter" class="btn btn-primary">
                </div>
            </div>

        </form>
    </div>
    <div class="col-md-6">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link active" href="
{{route('categories.index')}}">Published</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="
{{route('categories.trash')}}">Trash</a>
            </li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-right" style="margin-bottom: 10px;">
    <a href="{{route('categories.create')}}" class="btn btn-primary">Create
   category</a>
    </div>
   </div>
   
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-stripped">
            <thead>
                <tr>
                    <th><b>Name</b></th>
                    <th><b>Slug</b></th>
                    <th><b>Image</b></th>
                    <th><b>Actions</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{$category->name}}</td>
                    <td>{{$category->slug}}</td>
                    <td>
                        @if($category->image)
                        <img src="{{asset('public/storage/' . $category->image)}}" width="48px" />
                        @else
                        No image
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-info text-white btn-sm"
                            href="{{route('categories.edit', [$category->id])}}">Edit</a>
                        <a href="{{route('categories.show', [$category->id])}}"
                            class="btn btn-primary btn-sm">Detail</a>
                        <form onsubmit="return confirm('Delete this user permanently?')" class="d-inline"
                            action="{{route('categories.destroy', [$category->id])}}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colSpan="10">
                        {{$categories->appends(Request::all())->links()}}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@endsection
