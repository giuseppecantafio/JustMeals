@extends('layouts.app')

@section('content')

<div class="container">
    <h2>{{$category->name}}</h2>
    
    
    <button>
        <a href="{{route('admin.categories.edit', $category->id)}}">Edit</a>
    </button>
</div>


@endsection