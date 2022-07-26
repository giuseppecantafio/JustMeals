
<h1>Riepilogo del tuo ordine n° {{$transaction_id}}</h1>
<h2>{{$name}} {{$surname}}, grazie per aver ordinato su JustMeals</h2>
<p>La transazione è andata a buon fine, seguirà una mail di conferma da parte del ristorante di presa in carico del tuo ordine!</p>

<h3>L'ordine contiene:</h3>
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
<p>Riceverai una mail di conferma con l'orario di consegna aggiornato, appena il suo ordine verrà confermato!</p>
