@extends('layouts.app')

@section('content')

   
<div class="container">
    <h1>Nome piatto: {{$item->name}}</h1>
    <h3>Prezzo: {{$item->price}}</h3>
    <div>
        <img src="{{asset("storage/".$item->image)}}" alt="piatto" class="img-fluid">
    </div>
    <h4>Descrizione: {{$item->description}}</h4>
    <h3>Disponibilità: {{$item->available}}</h3>
    <ul>
        @foreach ($item->tags as $tag)
            <li>{{$tag->name}}</li>
        @endforeach
    </ul>
</div>
    
@endsection