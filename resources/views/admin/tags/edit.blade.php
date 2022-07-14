@extends('layouts.app')

@section('content')

<h1>MODIFICA TAG PER I PIATTI</h1>

<form action="{{route('admin.tags.update', $tag->id)}}" method="post">
    @csrf
    @method('PUT')

  <div class="form-group mb-3">
    <label for="name">Nome</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Inserisci nome" name="name" value="{{old('name', $tag->name)}}" required>

    @error('name')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror
  </div>

  <button type="submit" class="btn btn-primary">Invia</button>
</form>
@endsection