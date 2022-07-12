@extends('layouts.app')

@section('content')

<div class="container">
    <button class="btn btn-success">
        <a href="{{route('admin.restaurants.create')}}" style="color: white">Aggiungi Ristorante</a>
    </button>
        @foreach ($restaurants as $restaurant)
            <div class="d-flex align-items-center my-3">
                <a href="{{route('admin.restaurants.show', $restaurant->id)}}">{{$restaurant->name}}</a>
                <button class="btn btn-warning mx-3"><a href="{{route('admin.restaurants.edit', $restaurant->id)}}" style="color: black">Edit</a></button>
                <form action="{{route('admin.restaurants.destroy', $restaurant->id)}}" method="post" >
                    @csrf
                    @method('DELETE')
    
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                </form>
            </div>
        @endforeach
</div>
    
@endsection