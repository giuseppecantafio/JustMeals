@extends('layouts.app')

@section('content')

<div class="container">

  <h1>MODIFICA L'ORDINE DI {{$order->customer->surname.'   '.$order->customer->name}}</h1>
  
  
  <form action="{{route('admin.orders.update', $order->id)}}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PUT')
  
    <div class="form-group mb-3">
      <label for="delivery">Nome</label>
      <input type="text" class="form-control" id="delivery" placeholder="Inserisci nuovo orario" name="delivery" value="{{$order->delivery_time}}" required>
    </div>

    <div class="form-group">
      <label for="confirmed">Confirmed</label>
      <input type="checkbox" name="confirmed" id="confirmed">
    </div>
  
  
    <button type="submit" class="btn btn-primary">Invia</button>
  </form>
</div>

@endsection