@extends('layouts.app')

@section('content')

<div class="container">
  <h1>CREA RISTORANTE</h1>
  
  <form action="{{route('admin.restaurants.store')}}" method="post" enctype="multipart/form-data" class="js-form-check" id="form-js">
      @csrf
  
    <div class="form-group mb-3">
      <label for="name">Nome</label>
      <span class="mx-2">* <small class="mx-2" style="color: grey">Max 100 caratteri</small></span>
      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Inserisci nome" name="name" value="{{old('name')}}" maxlength="100" title="Il ristorante può contenere massimo 100 caratteri" required>
      @error('name')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  
    <div class="form-group mb-3">
      <label for="address">Indirizzo</label>
      <span class="mx-2">*</span>
      <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Es. Via po, 45" name="address" value="{{old('address')}}" required>

      @error('address')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      
      @if (session('myError'))
        <div class="alert alert-danger">
            {{ session('myError') }}
        </div>
      @endif
  
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
      <input type="text" class="form-control @error('vat') is-invalid @enderror" id="vat" placeholder="Inserisci la partita IVA" name="vat" value="{{old('vat')}}" required>
      
      @error('vat')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  
      <div class="form-group">
          <h5>Tipologia di Servizi<span class="mx-2">*</span></h5>
          
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
  
      <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary check-address">Invia</button>

        <div>* Campi Obbligatori</div>
      </div>
  </form>

</div>

<script src="{{asset('js/admin.js')}}"></script>

@endsection