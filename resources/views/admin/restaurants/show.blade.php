@extends('layouts.app')

@section('content')
<div class="container">
    
    <h2>{{$restaurant->name}}</h2>
    <h4>{{$restaurant->address}}</h4>
    
    <ul>
        @foreach ($restaurant->typologies as $typ)
            <li>{{$typ->name}}</li>
        @endforeach
    </ul>
    
    <button>
        <a href="{{route('admin.restaurants.edit', $restaurant->id)}}">Edit</a>
    </button>
    
    <button>
        <a href="{{route('admin.items.index', $restaurant->id)}}">Menu</a>
    </button>

</div>

@endsection