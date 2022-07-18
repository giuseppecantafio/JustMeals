@extends('layouts.app')

@section('content')

<div class="container">
    <div>
        <h1 style="display: inline-block">{{$restaurant->name}}</h1>
        <button class="btn btn-success" style="float: right">
            <a style="color: white" href="{{route('admin.items.create', $restaurant->id)}}">Crea nuovo piatto</a>
        </button>
        <h2 class="text-success">MENU</h2>
    
    </div>

    <div>
        @foreach($items as $item)
        <div class="d-flex my-3 align-items-center" style="gap: 30px">
            {{-- edit btn --}}
            <button class="btn btn-warning" >
                <a href="{{route('admin.items.edit', [ 'id' => $restaurant->id, 'item' => $item->id ])}}">Edit</a>
            </button>

            {{-- delete btn --}}
            <form action="{{route('admin.items.destroy', [ 'id' => $restaurant->id, 'item' => $item->id ])}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Elimina piatto</button>
            </form>

            <div style="height: 50px">
                <img style="height: 100%" src="{{asset("storage/".$item->image)}}" alt="immagine del piatto">
            </div>

            {{-- nome --}}
            <a href="{{route('admin.items.show', [ 'id' => $restaurant->id, 'item' => $item->id ])}}">{{$item->name}}</a>

        </div>
        @endforeach

    </div>
    
@endsection