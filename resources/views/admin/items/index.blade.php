@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Menu ristorante: {{$restaurant->name}}</h1>
    <div class="container">
            @foreach($items as $item)
            <div>{{$item->name}}</div>
            @endforeach
    </div>
</div>
    
@endsection