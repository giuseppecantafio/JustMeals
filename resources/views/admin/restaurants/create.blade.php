@extends('layouts.app')

@section('content')

<h1>CREA RISTORANTE</h1>

<form action="{{route('admin.restaurants.store')}}" method="post" enctype="multipart/form-data">
    @csrf

  <div class="form-group mb-3">
    <label for="name">Nome</label>
    <input type="text" class="form-control" id="name" placeholder="Inserisci nome" name="name" value="{{old('name')}}" required>
  </div>

  <div class="form-group mb-3">
    <label for="address">Indirizzo</label>
    <input type="text" class="form-control" id="address" placeholder="Inserisci la via" name="address" value="{{old('address')}}" required>
  </div>

  <div class="form-group mb-3">
    <label for="image">Inserisci immagine</label>
    <input type="file" id="image" placeholder="Inserisci immagine" name="image" required>
  </div>

  <div class="form-group mb-3">
    <label for="vat">Partita IVA</label>
    <input type="text" class="form-control" id="vat" placeholder="Inserisci la partita IVA" name="vat" value="{{old('vat')}}" required>
  </div>


  <button type="submit" class="btn btn-primary">Invia</button>
</form>
@endsection