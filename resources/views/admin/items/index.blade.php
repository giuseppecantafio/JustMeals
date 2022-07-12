@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Menu ristorante: {{$restaurant->name}}</h1>
    <div class="container">
            @foreach($items as $item)
            <div>{{$item->name}}</div>
            <button>
                <a href="{{route('admin.items.edit', 
                [ 'id' => $restaurant->id,
                'item' => $item->id ]
                    )}}">Edit</a>
            </button>
            @endforeach
    </div>
</div>
    
@endsection