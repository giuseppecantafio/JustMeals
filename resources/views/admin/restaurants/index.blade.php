@extends('layouts.app')

@section('content')

<button>
    <a href="{{route('admin.restaurants.create')}}">Aggiungi Ristorante</a>
</button>

<ul>
    @foreach ($restaurants as $restaurant)
        <li>
            <a href="{{route('admin.restaurants.show', $restaurant->id)}}">{{$restaurant->name}}</a>
        </li>
    @endforeach
    
</ul>
    
@endsection