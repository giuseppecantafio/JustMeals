@extends('layouts.app')

@section('content')

<h1>MODIFICA LE CATEGORIE PER I TUOI PIATTI</h1>

<form action="{{route('admin.categories.update', $category->id)}}" method="post">
    @csrf
    @method('PUT')

  <div class="form-group mb-3">
    <label for="name">Nome</label>
    <input type="text" class="form-control" id="name" placeholder="Inserisci nome" name="name" value="{{$category->name}}" required>
  </div>

  <button type="submit" class="btn btn-primary">Invia</button>
</form>
@endsection