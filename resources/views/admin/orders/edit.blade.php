@extends('layouts.app')

@section('content')

<div class="container admin-orders-edit">

  <h1>
    <span>RIEPILOGO DELL'ORDINE N. </span>
    <span>{{$order->id}}</span>
  </h1>
  <h2>
    <span>di </span>
    <span>{{$order->customer->surname.'   '.$order->customer->name}}</span>
    
  </h2>


  <section class="riepilogo">

    {{-- riepilogo --}}
    @foreach ($rawItems as $item)
      <div class="item">

        <div>
          <strong style="margin-left: -40px; margin-right: 16px">{{$item['pivot_quantity']}} x</strong>
          <span class="item-span">{{$item['name']}}</span>
        </div>

        <div>
          <span>Prezzo di Vendita : </span>
          <strong>{{$item['price']}} &euro;</strong>
        </div>

        <div>
          <span>Prezzo Parziale : </span>
          <strong>{{$item['price'] * $item['pivot_quantity']}} &euro;</strong>
        </div>

      </div>
        
    @endforeach

  </section>

  <section class="tot_price">
    <h3>
      <span>Prezzo Totale : </span>
      <strong>{{$order->total_price}} &euro;</strong>
    </h3>
  </section>

  

  

  {{-- form --}}
  <form action="{{route('admin.orders.update', [$restaurant_id, $order->id])}}" method="post" enctype="multipart/form-data">
      @csrf
      @method('PUT')
  
    <div class="form-group mb-3">
      <label for="delivery">Orario</label>
      <input type="time" class="form-control" id="delivery" placeholder="Inserisci nuovo orario" name="delivery" value="{{$order->delivery_time}}" style="width: auto; padding: 20px" required>
    </div>

    <input type="checkbox" name="confirmed" id="confirmed" style="display: none" checked>
  
    <div class="btns">
      {{-- conferma --}}
      <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-success">Conferma</button>
  
      </div>
  
    </div>
    
  </form>
  {{-- annulla --}}
  <form style="margin-top: 20px" action="{{route('admin.orders.destroy', [$restaurant_id, $order->id])}}" method="post" >
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Rifiuta</button>
</form>
</div>

@endsection