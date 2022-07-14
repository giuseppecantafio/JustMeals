@extends('layouts.app')

@section('content')

<h1>CREA UNA NUOVA CATEGORIA</h1>

<form action="{{route('admin.categories.store')}}" method="post">
    @csrf

  <div class="form-group mb-3">
    <label for="name">Nome</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Inserisci nome" name="name" value="{{old('name')}}" required>

    @error('name')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror
  </div>

  <button type="submit" class="btn btn-primary">Invia</button>
</form>
@endsection