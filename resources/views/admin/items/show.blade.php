@extends('layouts.app')

@section('content')

   
{{-- <div class="container"> --}}
    {{-- <button class="btn btn-warning" style="float: right">
        <a href="{{route('admin.items.edit', [ 'id' => $restaurant_route->id, 'item' => $item->id ])}}">Edit</a>
    </button> --}}
    {{-- <h1>Nome piatto: {{$item->name}}</h1>
    <h3>Prezzo: {{$item->price}}&euro;</h3> --}}
    {{-- <div style="height: 200px; width: 300px;">
        <img style="height: 100%" src="{{asset("storage/".$item->image)}}" alt="piatto" class="img-fluid">
    </div> --}}
    {{-- <h4>Descrizione:</h4>
    <p>{{$item->description}}</p> --}}


    {{-- <h3>Disponibilità: 
        @if ($item->available == 1)
        <i style="color: green" class="fa-solid fa-circle-check"></i>
        @else
        <i style="color: red" class="fa-solid fa-circle-xmark"></i>
        @endif
    </h3> --}}
    {{-- <div>TAGS</div> --}}
    {{-- <ul>
        @foreach ($item->tags as $tag)
            <li>{{$tag->name}}</li>
        @endforeach
    </ul> --}}

    {{-- <div>CATEGORIA: {{$item->category? $item->category->name : 'Senza categoria'}}</div> --}}
{{-- </div>
     --}}


<section class="admin-items-show">
<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-end align-items-end">
            <div class="bottone-storto mx-4">
                <div class="pos">Modifica</div>
                    <div class="prospettiva">
                    <a class="storto btn" href="{{route('admin.items.edit', [ 'id' => $restaurant_route->id, 'item' => $item->id ])}}">
                        <span style="color: transparent">Modifica</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">

    <!-- dati item -->
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <h1>{{$item->name}}</h1>
            <div class="d-flex tags">
                <h5><span class="mylabel">Tag:</span></h5>
                @foreach ($item->tags as $tag)
                    <div><h5 class="mx-2 h6 text-center rounded-pill">{{$tag->name}}</h5></div>
                @endforeach
            </div>
            <div>
                <h5><span class="mylabel">Categoria: </span>{{$item->category? $item->category->name : 'Senza categoria'}}</h5>
            </div>
            <div>
                <h5><span class="mylabel">Prezzo: </span>{{$item->price}}&euro;</h5>
            </div>
            <div>
                <h5><span class="mylabel">Descrizione: </span>{{$item->description}}</h5>
            </div>
            <div>
                <h5><span class="mylabel">Disponibilità: </span>
                    @if ($item->available == 1)
                    <i style="color: green" class="fa-solid fa-circle-check"></i>
                    @else
                    <i style="color: red" class="fa-solid fa-circle-xmark"></i>
                    @endif
                </h5>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 img-wrapper">
            @if($item->image)
                <div class="img-container">
                    <img class="img-fluid" src="{{asset("storage/".$item->image)}}" alt="Immagine piatto">
                </div>
                @else 
                <div>
                <p style="margin-top: 80px;">Non è presente un'immagine per il piatto</p>
                </div>
                @endif
        </div>
    </div>

    {{-- <!-- indirizzo e menù con immagine responsive -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="left-block">
                    <h3 class="address">{{$restaurant->address}}</h3>
                    <div class="bottone-storto py-4">
                        <div class="pos">Menu</div>
                        <div class="prospettiva">
                            <a class="storto btn" href="{{route('admin.items.index', $restaurant->id)}}">
                                <span style="color: transparent">Menu</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                @if($restaurant->image)
                <div class="right-block img-container">
                    <img class="img-fluid" src="{{asset("storage/".$restaurant->image)}}" alt="Immagine ristorante">
                </div>
                @else 
                <div class="right-block">
                <p>Non è presente un'immagine per il ristorante</p>
                </div>
                @endif
            </div>
            
        </div>
    </div>
</div> --}}

</section>
@endsection