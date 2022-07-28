@extends('layouts.app')

@section('content')

<section class="admin-items-index">
<div class="create-container">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <h1>{{$restaurant->name}}</h1>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="container d-flex justify-content-center align-items-center">
                    <div class="bottone-storto">
                        <div class="pos">Aggiungi un piatto!</div>
                            <div class="prospettiva">
                                <a class="storto btn" href="{{route('admin.items.create', $restaurant->id)}}">
                                    <span style="color: transparent">Aggiungi un piatto!</span>
                                </a>
                            </div>
                    </div>
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
              <th scope="col">ID piatto</th>
              <th scope="col">Nome</th>
              <th scope="col">Prezzo</th>
              <th scope="col">Immagine</th>
              <th scope="col">Disponibilità</th>
              <th scope="col">Modifica dati</th>
              <th scope="col">Elimina piatto</th>
            </tr>
          </thead>
          <tbody>
             @foreach($items as $item)
            <tr>
                <td>
                    <p>{{$item->id}}</p>
                </td>
                <td>
                    <a href="{{route('admin.items.show', [ 'id' => $restaurant->id, 'item' => $item->id ])}}"">
                    {{$item->name}}
                    </a>
                </td>
                <td>
                    <p>
                    {{$item->price}} &euro;
                    </p>
                </td>
                <td>
                    <p>
                    {{$item->image == null ? 'Nessuna immagine caricata' : 'Immagine caricata'}}
                    </p>
                </td>
                <td>
                    <p>
                    @if ($item->available == 1)
                        <i style="color: green" class="fa-solid fa-circle-check"></i>
                    @else
                        <i style="color: red" class="fa-solid fa-circle-xmark"></i>
                    @endif
                    </p>
                </td>
                <td>
                    <button class="btn btn-warning mx-3"><a href="{{route('admin.items.edit', [ 'id' => $restaurant->id, 'item' => $item->id ])}}" style="color: black">Modifica</a></button>
                </td>
                <td>
                   <form action="{{route('admin.items.destroy', [ 'id' => $restaurant->id, 'item' => $item->id ])}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Elimina</button>
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