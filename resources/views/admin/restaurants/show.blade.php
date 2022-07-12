@extends('layouts.app')

@section('content')

{{-- @dd($restaurant->typologies) --}}

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

@endsection