@extends('layouts.app')

@section('content')

<div class="container">
    <button class="btn btn-success">
        <a href="{{route('admin.tags.create')}}" style="color: white">Aggiungi tag per il tuo piatto</a>
    </button>
        @foreach ($tags as $tag)
            <div class="d-flex align-items-center my-3">
                <a href="{{route('admin.tags.show', $tag->id)}}">{{$tag->name}}</a>
                <button class="btn btn-warning mx-3"><a href="{{route('admin.tags.edit', $tag->id)}}" style="color: black">Edit</a></button>
                <form action="{{route('admin.tags.destroy', $tag->id)}}" method="post" >
                    @csrf
                    @method('DELETE')
    
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                </form>
            </div>
        @endforeach
</div>
    
@endsection