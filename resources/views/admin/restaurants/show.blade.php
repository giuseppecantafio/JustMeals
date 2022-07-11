@extends('layouts.app')

@section('content')

<h2>{{$restaurant->name}}</h2>
<h4>{{$restaurant->address}}</h4>

<button>
    <a href="{{route('admin.restaurants.edit', $restaurant->id)}}">Edit</a>
</button>

@endsection