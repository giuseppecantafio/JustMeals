
<h1>Riepilogo dell'ordine n° {{$transaction_id}}</h1>
<h2>L'utente {{$name}} {{$surname}} ha ordinato quanto segue:</p>

<ul>
    @foreach ($order as $item)
    <li>
        <div>Prodotto: {{$item['stats']->name}}</div>
        <div>Quantità: {{$item['quantity']}}</div>
        <div>Prezzo: {{$item['stats']->price}}</div>
    </li>
    @endforeach
</ul>

<p>Costo totale {{$amount}}</p>
<p>Si prega di confermare l'orario nell'apposita pagina LINK</p>
