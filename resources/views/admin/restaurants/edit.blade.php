@extends('layouts.app')

@section('content')

<div class="container">
    <h1>MODIFICA IL TUO RISTORANTE</h1>
    
    <form action="{{route('admin.restaurants.update', $restaurant->id)}}" method="post" enctype="multipart/form-data" class="form-js">
        @csrf
        @method('PUT')
    
      <div class="form-group mb-3">
        <label for="name-form">Nome</label>
        <span class="mx-2">* <small class="mx-2" style="color: grey">Max 100 caratteri</small></span>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name-form" placeholder="Inserisci nome" name="name" value="{{old('name', $restaurant->name)}}" required maxlength="100" title="Il ristorante può contenere massimo 100 caratteri" >
    
        @error('name')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="name-error d-none alert alert-danger">Devi inserire un nome</div>
      </div>
    
      <div class="form-group mb-3">
        <label for="address">Indirizzo</label>
        <span class="mx-2">*</span>
        <input type="text" class="form-control" id="address" placeholder="Es. Via po, 45" name="address" value="{{old('address', $restaurant->address)}}" required>
    
        @error('address')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    
        @if (session('myError'))
          <div class="alert alert-danger">
            {{ session('myError') }}
          </div>
        @endif

        <div class="viaAddress-error d-none alert alert-danger">Inserisci una Via valida ('Via', 'Corso', 'Strada', ecc...)</div>
        <div class="numberAddress-error d-none alert alert-danger">Inserisci un numero civico</div>

      </div>
    
      <div class="form-group mb-3">
        <label for="image">Inserisci immagine</label>
        <input type="file" id="image" class="@error('image') is-invalid @enderror" placeholder="Inserisci immagine" name="image">
    
        @error('image')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
      </div>
    
      <div class="form-group mb-3">
        <label for="vat">Partita IVA</label>
        <span class="mx-2">*</span>
        <input type="text" class="form-control @error('vat') is-invalid @enderror" id="vat" placeholder="Inserisci la partita IVA" name="vat" value="{{old('vat', $restaurant->vat)}}" required>
    
        @error('vat')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="vat-error d-none alert alert-danger">La partita Iva deve contenere solo numeri ed essere di 11 cifre</div>
      </div>
    
      <div class="form-group">
            <h5>Tipologia di Servizi<span class="mx-2">*</span></h5>
            
            @foreach ($typologies as $typology)
                <div class="form-check form-check-inline">
                    <input type="checkbox" class="form-check-input" {{$restaurant->typologies->contains($typology) ? 'checked' : ''}} id="{{$typology->slug}}" name="typologies[]" value="{{$typology->id}}">
                    <label class="form-check-label"  for="{{$typology->slug}}">{{$typology->name}}</label>
                </div>
            @endforeach
            @error('tags')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="typology-error d-none alert alert-danger">Seleziona almeno una categoria per il tuo ristorante</div>
      </div>
    
      <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary restaurant-submit">Invia</button>

        <div>* Campi Obbligatori</div>
      </div>
    </form>

</div>

<script src="{{asset('js/admin.js')}}"></script>

@endsection