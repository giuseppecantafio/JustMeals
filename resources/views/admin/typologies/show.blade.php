@extends('layouts.app')

@section('content')

<h2>{{$typology->name}}</h2>
<h4>{{$typology->address}}</h4>

<button>
    <a href="{{route('admin.typologies.edit', $typology->id)}}">Edit</a>
</button>

@endsection