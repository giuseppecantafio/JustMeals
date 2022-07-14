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
    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Es. Via po, 45" name="address" value="{{old('address')}}" required>
    @error('address')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
  </div>

  <div class="form-group mb-3">
    <label for="image">Inserisci immagine</label>
    <input type="file" id="image" placeholder="Inserisci immagine" name="image">
  </div>

  <div class="form-group mb-3">
    <label for="vat">Partita IVA</label>
    <input type="text" class="form-control @error('vat') is-invalid @enderror" id="vat" placeholder="Inserisci la partita IVA" name="vat" value="{{old('vat')}}" required>
    @error('vat')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
  </div>

  {{-- <div class="form-group mb-3">
    <label for="typology">Servizi Offerti</label>
    <input type="text" class="form-control" id="vat" placeholder="Inserisci la partita IVA" name="vat" value="{{old('vat')}}" required>
  </div> --}}

  {{-- <div class="form-group form-check">
      <input type="checkbox" class="form-check-input  @error('typology') is-invalid @enderror" {{old('typology') ? 'checked' : ''}} id="typology" name="typology">
      <label class="form-check-label"  for="typology">Tipologia di servizi</label>
      @error('typology')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div> --}}

    <div class="form-group">
        <h5>Tipologia di Servizi</h5>
        @foreach ($typologies as $typology)
            <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" {{in_array($typology->id, old("typologies", [])) ? 'checked' : ''}} id="{{$typology->slug}}" name="typologies[]" value="{{$typology->id}}">
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