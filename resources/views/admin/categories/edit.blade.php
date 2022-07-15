@extends('layouts.app')

@section('content')

<div class="container">

  <h1>MODIFICA LE CATEGORIE PER I TUOI PIATTI</h1>
  
  <form action="{{route('admin.categories.update', $category->id)}}" method="post">
      @csrf
      @method('PUT')
  
    <div class="form-group mb-3">
      <label for="name">Nome</label>
      <span class="mx-2">*</span>
      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Inserisci nome" name="name" value="{{old('name', $category->name)}}" required>
  
      @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
  
    <div class="d-flex justify-content-between">
      <button type="submit" class="btn btn-primary">Invia</button>
  
      <div>* Campi Obbligatori</div>
    </div>
  </form>
</div>

@endsection