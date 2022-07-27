@extends('layouts.app')

@section('content')

<section class="admin-items-create">
  <div class="container">
  <div class="row w-75 m-auto">

    <div class="col-12 start-form">
          <h1>Aggiungi piatto al tuo menu</h1>
      
        <form action="{{route('admin.items.store', $restaurant->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
      
        <div class="form-group mb-3">
          <label for="name">Nome</label>
          <span class="mx-2">* <small class="mx-2" style="color: grey">Max 150 caratteri</small></span>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Inserisci nome piatto" name="name" value="{{old('name')}}" maxlength="150" required>
      
          @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
          @enderror
        </div>
      
        <div class="form-group mb-3">
          <label for="price">Prezzo</label>
          <span class="mx-2">*</span>
          <input type="number" step="0.01" min="0.20" max="999" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Inserisci il prezzo" name="price" value="{{old('price')}}" required>
      
          @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
      
        <div class="form-group mb-3">
          <label for="image">Inserisci immagine</label>
          <input type="file" class="@error('image') is-invalid @enderror" id="image" placeholder="Inserisci immagine" name="image">
      
          @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
      
        <div class="form-group mb-3">
          <label for="description">Descrizione piatto</label>
          <span class="mx-2">* <small class="mx-2" style="color: grey">Max 1000 caratteri</small></span>
          <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required maxlength="1000">{{old('description')}}</textarea>
      
          @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
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
      
          <div class="form-group">
            <label for="category">Selezionare categoria</label>
            <select name="category" id="category">
              <option value="">Selezionare categoria</option>
            @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
            </select>
          </div>
      
        <div class="d-flex justify-content-between">
              <div class="bottone-storto mx-4">
                <div class="pos">Invia</div>
                    <div class="prospettiva">
                    <button type="submit" class="storto btn">
                        <span style="color: transparent">Invia</span>
                    </button>
                </div>
              </div>
              <div>* Campi Obbligatori</div>
            </div>
        </form>
    </div>
  </div>
  </div>
</section>
    
@endsection