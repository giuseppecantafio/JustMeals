@extends('layouts.app')

@section('content')

<h2>{{$category->name}}</h2>


<button>
    <a href="{{route('admin.categories.edit', $category->id)}}">Edit</a>
</button>

@endsection