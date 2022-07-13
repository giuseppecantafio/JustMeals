@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Menu ristorante: {{$restaurant->name}}</h1>

           <button>
            <a href="{{route('admin.items.create', $restaurant->id)}}">Crea nuovo piatto</a>
           </button>
                @foreach($items as $item)
                <div>
                    <a href="{{route('admin.items.show', 
                    [ 'id' => $restaurant->id,
                    'item' => $item->id ]
                        )}}">{{$item->name}}</a>
                <button>
                    <a href="{{route('admin.items.edit', 
                    [ 'id' => $restaurant->id,
                    'item' => $item->id ]
                        )}}">Edit</a>
                </button>

                <form action="{{route('admin.items.destroy', 
                    [ 'id' => $restaurant->id,
                    'item' => $item->id ]
                        )}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Elimina piatto
                    </button>
                </form>
            </div>
                @endforeach
</div>
    
@endsection