@extends('layouts.app')

@section('content')

<div class="container">
  <h1>CREA ORDINE!</h1>
  
  <form action="{{route('admin.orders.store')}}" method="post">
      @csrf
  
      <h2>SCELTA PIATTI</h2>
    <div class="form-group mb-3">
      <label for="item1">Scegli piatto</label>
      <select name="item1" id="item1">
        <option value="">Scegli un solo piatto</option>
        @foreach ($items as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
        @endforeach
      </select>
      <input type="number" min="1" max="5" name="quantity1">
    </div>
  
    <div class="form-group mb-3">
      <label for="item2">Scegli piatto</label>
      <select name="item2" id="item2">
        <option value="">Scegli un solo piatto</option>
        @foreach ($items as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
        @endforeach
      </select>
      <input type="number" min="1" max="5" name="quantity2">
    </div>
  
    <div class="form-group mb-3">
      <label for="item3">Scegli piatto</label>
      <select name="item3" id="item3">
        <option value="">Scegli un solo piatto</option>
        @foreach ($items as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
        @endforeach
      </select>
      <input type="number" min="1" max="5" name="quantity3">
    </div>
  
    <div class="form-group mb-3">
      <label for="delivery">Inserire un orario di consegna</label>
      <input type="time" id="delivery" name="delivery"
         min="09:00" max="18:00" value="{{old('delivery')}}" required>
    </div>
  
    <h2>DATI UTENTE</h2>
  
    <div class="form-group mb-3">
      <label for="userName">Nome utente</label>
      <input type="text" class="form-control" id="userName" placeholder="Inserisci il tuo nome" name="userName" value="{{old('userName')}}" required>
    </div>
  
      <div class="form-group mb-3">
      <label for="userSurname">Cognome utente</label>
      <input type="text" class="form-control" id="userSurname" placeholder="Inserisci il tuo cognome" name="userSurname" value="{{old('userSurname')}}" required>
    </div>
  
    <div class="form-group mb-3">
      <label for="userEmail">Email utente</label>
      <input type="email" class="form-control" id="userEmail" placeholder="Inserisci la tua email" name="userEmail" value="{{old('userEmail')}}" required>
    </div>
  
    <div class="form-group mb-3">
      <label for="userAddress">Indirizzo utente</label>
      <input type="text" class="form-control" id="userAddress" placeholder="Inserisci la tua via" name="userAddress" value="{{old('userAddress')}}" required>
    </div>
  
    <div class="form-group mb-3">
      <label for="userNote">Note utente</label>
      <textarea name="userNote" id="userNote" >{{old('userNote')}}</textarea>
    </div>
  
  
    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Invia</button>

        <div>* Campi Obbligatori</div>
      </div>
  </form>
</div>
@endsection