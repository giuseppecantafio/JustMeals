@extends('layouts.app')

@section('content')
<section class="admin-home">
    <div class="h1 text-left py-3">Benvenuto {{ auth()->user()->name }} {{ auth()->user()->surname }}!</div>
    <div class="h1 text-right py-3">Accedi alle tue pagine personali</div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-6 d-flex justify-content-center buttons-container">
                    <div class="bottone-storto">
                        <div class="pos">Ristoranti</div>
                            <div class="prospettiva">
                                <a class="storto btn" href="{{ route('admin.restaurants.index') }}">
                                    <span style="color: transparent">Ristoranti</span>
                                </a>
                            </div>
                    </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 d-flex justify-content-center buttons-container">
                {{-- <div class="bottone-storto">
                    <div class="pos">Ordini ricevuti</div>
                        <div class="prospettiva">
                            <a class="storto btn" href="{{ route('admin.orders.index') }}">
                                <span style="color: transparent">Ordini ricevuti</span>
                            </a>
                        </div>
                    </div>
                </div> --}}
        </div>
    </div>
</section>
    @endsection



{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <h1>HOME aaa</h1>
            </div>
        </div>
    </div>
</div> --}}