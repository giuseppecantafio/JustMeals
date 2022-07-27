@extends('layouts.app')

@section('content')

<h2>Numero Ordine : {{$order->id}}</h2>
<h3>Orario di consegna : {{$order->delivery_time}}</h3>
<h3>Prezzo totale : {{$order->total_price}}</h3>
<h4>{{$order->note}}</h4>

<div>{{$order->customer->name.' - '.$order->customer->surname}}</div>

<button>
    <a href="{{route('admin.orders.edit', [$restaurant->id, $order->id])}}">Edit</a>
</button>

@endsection