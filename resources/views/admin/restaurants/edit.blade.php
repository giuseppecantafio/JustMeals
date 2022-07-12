@extends('layouts.app')

@section('content')

<h1>MODIFICA IL TUO RISTORANTE</h1>

<form action="{{route('admin.restaurants.update', $restaurant->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

  <div class="form-group mb-3">
    <label for="name">Nome</label>
    <input type="text" class="form-control" id="name" placeholder="Inserisci nome" name="name" value="{{$restaurant->name}}" required>
  </div>

  <div class="form-group mb-3">
    <label for="address">Indirizzo</label>
    <input type="text" class="form-control" id="address" placeholder="Inserisci la via" name="address" value="{{$restaurant->address}}" required>
  </div>

  <div class="form-group mb-3">
    <label for="image">Inserisci immagine</label>
    <input type="file" id="image" placeholder="Inserisci immagine" name="image">
  </div>

  <div class="form-group mb-3">
    <label for="vat">Partita IVA</label>
    <input type="text" class="form-control" id="vat" placeholder="Inserisci la partita IVA" name="vat" value="{{$restaurant->vat}}" required>
  </div>

  <div class="form-group">
        <h5>Tipologia di Servizi</h5>
        @foreach ($typologies as $typology)
            <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" {{$restaurant->typologies->contains($typology) ? 'checked' : ''}} id="{{$typology->slug}}" name="typologies[]" value="{{$typology->id}}">
                <label class="form-check-label"  for="{{$typology->slug}}">{{$typology->name}}</label>
            </div>
        @endforeach
        @error('tags')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
  </div>

  <button type="submit" class="btn btn-primary">Invia</button>
</form>
@endsection