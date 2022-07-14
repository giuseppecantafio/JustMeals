@extends('layouts.app')

@section('content')

<h1>MODIFICA LE CATEGORIE PER I TUOI PIATTI</h1>

<form action="{{route('admin.categories.update', $category->id)}}" method="post">
    @csrf
    @method('PUT')

  <div class="form-group mb-3">
    <label for="name">Nome</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Inserisci nome" name="name" value="{{old('name', $category->name)}}" required>

    @error('name')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror
  </div>

  <button type="submit" class="btn btn-primary">Invia</button>
</form>
@endsection