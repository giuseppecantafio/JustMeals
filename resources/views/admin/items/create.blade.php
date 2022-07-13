@extends('layouts.app')

@section('content')
<div class="container">
    
    <h1>Aggiungi piatto al tuo menu</h1>

<form action="{{route('admin.items.store', $restaurant->id)}}" method="POST" enctype="multipart/form-data">
    @csrf

  <div class="form-group mb-3">
    <label for="name">Nome</label>
    <input type="text" class="form-control" id="name" placeholder="Inserisci nome piatto" name="name" value="{{old('name')}}" required>
  </div>

  <div class="form-group mb-3">
    <label for="price">Prezzo</label>
    <input type="number" step="0.1" min="0.20" max="999" class="form-control" id="price" placeholder="Inserisci il prezzo" name="price" value="{{old('price')}}" required>
  </div>

  <div class="form-group mb-3">
    <label for="image">Inserisci immagine</label>
    <input type="file" id="image" placeholder="Inserisci immagine" name="image">
  </div>

  <div class="form-group mb-3">
    <label for="description">Descrizione piatto</label>
    <textarea class="form-control" id="description" name="description" required>{{old('description')}}</textarea>
  </div>

  <div class="form-group mb-3 form-check">
      <input type="checkbox" class="form-check-input  @error('available') is-invalid @enderror" {{old('available') ? 'checked' : ''}} id="available" name="available">
      <label class="form-check-label"  for="available">Piatto disponibile?</label>
      @error('available')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group">
        <h5>Aggiungi tag</h5>
        @foreach ($tags as $tag)
            <div class="form-check form-check-inline">
                <input type="checkbox" class="form-check-input" {{in_array($tag->id, old("tags", [])) ? 'checked' : ''}} id="{{$tag->slug}}" name="tags[]" value="{{$tag->id}}">
                <label class="form-check-label"  for="{{$tag->slug}}">{{$tag->name}}</label>
            </div>
        @endforeach
        @error('tags')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

  <button type="submit" class="btn btn-primary">Invia</button>
</form>

</div>
    
@endsection