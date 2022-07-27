@extends('layouts.app')

@section('content')

<section class="admin-restaurants-index">
<div class="create-container">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="bottone-storto">
            <div class="pos">Aggiungi ristorante! <i class="fa-solid fa-carrot"></i></div>
                <div class="prospettiva">
                    <a class="storto btn" href="{{ route('admin.restaurants.create') }}">
                        <span style="color: transparent">Aggiungi ristorante! <i class="fa-solid fa-carrot"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID ristorante</th>
              <th scope="col">Nome</th>
              <th scope="col">Indirizzo</th>
              <th scope="col">Modifica dati</th>
              <th scope="col">Elimina ristorante</th>
            </tr>
          </thead>
          <tbody>
             @foreach($restaurants as $restaurant)
            <tr>
                <td>
                    <p>{{$restaurant->id}}</p>
                </td>
                <td>
                    <a href="{{route('admin.restaurants.show', $restaurant->id)}}">
                    {{$restaurant->name}}
                    </a>
                </td>
                <td>
                    <p>
                    {{$restaurant->address}}
                    </p>
                </td>
                <td>
                    <button class="btn btn-warning mx-3"><a href="{{route('admin.restaurants.edit', $restaurant->id)}}" style="color: black">Modifica</a></button>
                </td>
                <td>
                    <form action="{{route('admin.restaurants.destroy', $restaurant->id)}}" method="post" >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('vuoi veramente eliminare il ristorante?');">Elimina</button>
                    </form>
                </td>
            </tr>
            
            @endforeach
        </tbody>
        </table>
    </div>
</div>
</section>
@endsection