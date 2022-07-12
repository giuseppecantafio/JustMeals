@extends('layouts.app')

@section('content')

<div class="container">
    <button class="btn btn-success">
        <a href="{{route('admin.typologies.create')}}" style="color: white">Aggiungi Servizio</a>
    </button>
        @foreach ($typologies as $typology)
            <div class="d-flex align-items-center my-3">
                <a href="{{route('admin.typologies.show', $typology->id)}}">{{$typology->name}}</a>
                <button class="btn btn-warning mx-3"><a href="{{route('admin.typologies.edit', $typology->id)}}" style="color: black">Edit</a></button>
                <form action="{{route('admin.typologies.destroy', $typology->id)}}" method="post" >
                    @csrf
                    @method('DELETE')
    
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                </form>
            </div>
        @endforeach
</div>
    
@endsection