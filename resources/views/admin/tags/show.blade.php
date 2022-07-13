@extends('layouts.app')

@section('content')

<h2>{{$tag->name}}</h2>


<button>
    <a href="{{route('admin.tags.edit', $tag->id)}}">Edit</a>
</button>

@endsection