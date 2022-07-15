@extends('layouts.app')

@section('content')

<div class="container">

    <h2>{{$typology->name}}</h2>
    <h4>{{$typology->address}}</h4>
    
    <button>
        <a href="{{route('admin.typologies.edit', $typology->id)}}">Edit</a>
    </button>
</div>


@endsection