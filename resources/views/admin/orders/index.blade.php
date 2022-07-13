@extends('layouts.app')

@section('content')

<div class="container">
    
        @foreach ($orders as $order)

        @if ($order->confirmed == 1)
            <div style="background: green;">Confermato</div>
        @else
            <div style="background: yellow;">Da confermare</div>
        @endif

            <div class=" align-items-center my-3">
                <a href="{{route('admin.orders.show', $order->id)}}">Ordine numero : {{$order->id}}</a>
                <div>{{$order->note}}</div>
                <div>{{$order->customer->name.' - '.$order->customer->surname}}</div>
                <div>{{$order->delivery_time}}</div>
                <div> EURO : {{$order->total_price}}</div>
                <button class="btn btn-warning mx-3"><a href="{{route('admin.orders.edit', $order->id)}}" style="color: black">Edit</a></button>
                <form action="{{route('admin.orders.destroy', $order->id)}}" method="post" >
                    @csrf
                    @method('DELETE')
    
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                </form>
            </div>
        @endforeach
</div>
    
@endsection