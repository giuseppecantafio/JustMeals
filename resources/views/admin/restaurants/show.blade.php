@extends('layouts.app')

@section('content')
<div class="container">
    <button class="btn btn-warning" style="float: right">
        <a href="{{route('admin.restaurants.edit', $restaurant->id)}}">Edit</a>
    </button>
    <button class="btn btn-warning" style="float: right">
        <a href="{{route('admin.charts.index', $restaurant->id)}}">Grafico</a>
    </button>
    
    <h2>{{$restaurant->name}}</h2>
    @if($restaurant->image)
    <div style="height:200px; width:200px">
        <img style="height: 100%" src="{{asset("storage/".$restaurant->image)}}" alt="">
    </div>
    @endif
    <h4>{{$restaurant->address}}</h4>
    
    <ul>
        @foreach ($restaurant->typologies as $typ)
            <li>{{$typ->name}}</li>
        @endforeach
    </ul>
    
    <button class="btn btn-primary">
        <a style="color: white" href="{{route('admin.items.index', $restaurant->id)}}">Menu</a>
    </button>
    

</div>

@endsection