@extends('layouts.app')

@section('content')
<section class="admin-restaurants-show">
<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-end align-items-end">
            <div class="bottone-storto mx-4">
                <div class="pos">Modifica</div>
                    <div class="prospettiva">
                    <a class="storto btn" href="{{route('admin.restaurants.edit', $restaurant->id)}}">
                        <span style="color: transparent">Modifica</span>
                    </a>
                </div>
            </div>
        <div class="bottone-storto">
            <div class="pos">Statistiche</div>
                <div class="prospettiva">
                    <a class="storto btn" href="{{route('admin.charts.index', $restaurant->id)}}">
                        <span style="color: transparent">Statistiche</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="container">

    <!-- name + tipologie -->
    <div class="d-flex align-items-center">
        <h1>{{$restaurant->name}}</h1>
        <ul class="d-flex">
            @foreach ($restaurant->typologies as $typ)
                <div><li class="mx-2 h6 text-center rounded-pill" style="margin-top:18px;">{{$typ->name}}</li></div>
            @endforeach
        </ul>
    </div>

    <!-- indirizzo e menù con immagine responsive -->
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
                    <div class="bottone-storto">
                        <div class="pos">Ordini</div>
                            <div class="prospettiva">
                                <a class="storto btn" href="{{route('admin.orders.index', $restaurant->id)}}">
                                    <span style="color: transparent">Ordini</span>
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
    </div>
</div>

</section>

@endsection