@extends('layouts.app')

@section('content')

   
<div class="container">
    <button class="btn btn-warning" style="float: right">
        <a href="{{route('admin.items.edit', [ 'id' => $restaurant_route->id, 'item' => $item->id ])}}">Edit</a>
    </button>
    <h1>Nome piatto: {{$item->name}}</h1>
    <h3>Prezzo: {{$item->price}}&euro;</h3>
    <div style="height: 200px; width: 300px;">
        <img style="height: 100%" src="{{asset("storage/".$item->image)}}" alt="piatto" class="img-fluid">
    </div>
    <h4>Descrizione:</h4>
    <p>{{$item->description}}</p>


    <h3>Disponibilità: 
        @if ($item->available == 1)
        <i style="color: green" class="fa-solid fa-circle-check"></i>
        @else
        <i style="color: red" class="fa-solid fa-circle-xmark"></i>
        @endif
    </h3>
    <div>TAGS</div>
    <ul>
        @foreach ($item->tags as $tag)
            <li>{{$tag->name}}</li>
        @endforeach
    </ul>

    <div>CATEGORIA: {{$item->category? $item->category->name : 'Senza categoria'}}</div>
</div>
    
@endsection