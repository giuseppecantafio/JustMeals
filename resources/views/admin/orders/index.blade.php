@extends('layouts.app')

@section('content')

<div class="container admin-orders-index">

        <h1>ORDINI ARRIVATI</h1>

        <div class="row">

            @foreach ($orders as $order)
            
            
            <div class="col-md-6 col-sm-12 col-xl-4 colle">
                {{-- card --}}
                <div class="order-card align-items-center my-3">
                    {{-- confirm tag --}}
                    @if ($order->confirmed == 1)
                    <div class="tag confirmed-tag">Confermato</div>
                    @else
                    <div class="tag toconfirm-tag">Da confermare</div>
                    @endif

                    {{-- numero --}}
                    <a class="order-id" href="{{route('admin.orders.show', [$restaurant->id, $order->id])}}">Ordine numero : {{$order->id}}</a>
                    {{-- cliente --}}
                    <div class="name">
                        <span>Cliente : </span>
                        <span class="bold">{{$order->customer->name.'  '.$order->customer->surname}}</span>
                    </div>
                    {{-- note --}}
                    <div class="note">
                        <span>Note : </span>
                        <span class="bold">{{$order->note}}</span>
                    </div>
                    {{-- time --}}
                    <div class="time">
                        <span>Orario richiesto : </span>
                        <span class="bold">{{substr($order->delivery_time, 0, 5)}}</span>
                    </div>
                    {{-- price --}}
                    <div class="price">
                        <span>Prezzo : </span>
                        <span class="bold">{{$order->total_price}} &euro;</span>
                    </div>
                    {{-- buttons --}}
                    <div class="btns">
                        <button class="btn edit">
                            <a class="edit-btn" href="{{route('admin.orders.edit', [$restaurant->id ,$order->id])}}" style="color: black">Vai alla conferma</a>
                        </button>
                        <form action="{{route('admin.orders.destroy', [$restaurant->id, $order->id])}}" method="post" >
                            @csrf
                            @method('DELETE')
            
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Rifiuta</button>
                        </form>
                    </div>
                </div>
            </div>
    
            @endforeach

        </div>
    
</div>
    
@endsection