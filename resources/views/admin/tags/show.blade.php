@extends('layouts.app')

@section('content')

<div class="container">

    <h2>{{$tag->name}}</h2>
    
    
    <button>
        <a href="{{route('admin.tags.edit', $tag->id)}}">Edit</a>
    </button>
</div>


@endsection