@extends('layouts.app')

@section('content')
<div class="container">
    <button class="btn btn-success">
        <a href="{{route('admin.categories.create')}}" style="color: white">Aggiungi category per il tuo piatto</a>
    </button>
        @foreach ($categories as $category)
            <div class="d-flex align-items-center my-3">
                <a href="{{route('admin.categories.show', $category->id)}}">{{$category->name}}</a>
                <button class="btn btn-warning mx-3"><a href="{{route('admin.categories.edit', $category->id)}}" style="color: black">Edit</a></button>
                <form action="{{route('admin.categories.destroy', $category->id)}}" method="post" >
                    @csrf
                    @method('DELETE')
    
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                </form>
            </div>
        @endforeach
</div>
    
@endsection