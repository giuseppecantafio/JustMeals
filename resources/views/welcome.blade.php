<head>
  <meta charset="utf-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  {{-- brainTree --}}
  <script src="https://js.braintreegateway.com/web/dropin/1.33.2/js/dropin.min.js"></script>
    {{-- axios --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"></script>

</head>
<body>

    <div class="container">

        {{-- form dati utente --}}

    <form>

    <h2>DATI UTENTE</h2>
  
    <div class="form-group mb-3">
      <label for="userName">Nome utente</label>
      <input type="text" class="form-control" id="userName" placeholder="Inserisci il tuo nome" name="userName" value="{{old('userName')}}" required>
    </div>
  
      <div class="form-group mb-3">
      <label for="userSurname">Cognome utente</label>
      <input type="text" class="form-control" id="userSurname" placeholder="Inserisci il tuo cognome" name="userSurname" value="{{old('userSurname')}}" required>
    </div>
  
    <div class="form-group mb-3">
      <label for="userEmail">Email utente</label>
      <input type="email" class="form-control" id="userEmail" placeholder="Inserisci la tua email" name="userEmail" value="{{old('userEmail')}}" required>
    </div>
  
    <div class="form-group mb-3">
      <label for="userAddress">Indirizzo utente</label>
      <input type="text" class="form-control" id="userAddress" placeholder="Inserisci la tua via" name="userAddress" value="{{old('userAddress')}}" required>
    </div>
  
    {{-- note --}}
    <div class="form-group mb-3">
      <label for="userNote">Note utente</label>
      <textarea name="userNote" id="userNote" >{{old('userNote')}}</textarea>
    </div>

    {{-- orario --}}
    <div class="form-group mb-3">
      <label for="delivery">Inserire un orario di consegna</label>
      <input type="time" id="delivery" name="delivery"
         min="09:00" max="18:00" value="{{old('delivery')}}" required>
    </div>
    

  </form>




        {{-- drop - in --}}
        <div id="dropin-container"></div>
      
        <h2>Riepilogo</h2>

        <div id="info-cart"></div>

        <div id="total_price"></div>
      
        <button id="payBtn" class="btn btn-success">Pagahh Stronzoooohhhh</button>
    </div>

  <script type="text/javascript">

// carrello  

let cartItems = []
let priceTotal = 0
const TOT_PRICE = document.getElementById('total_price')
const userName = document.getElementById('userName')
const userSurname = document.getElementById('userSurname')
const userEmail = document.getElementById('userEmail')
const userAddress = document.getElementById('userAddress')
const userNote = document.getElementById('userNote')
const userTime = document.getElementById('delivery')


let datiUtente = {
    name : '',
    surname : '',
    email : '',
    address : '',
    note : '',
    delivery_time: ''
}


function getCartItems() {
            for (const [key, value] of Object.entries(window.localStorage)) {
                let newValue = JSON.parse(value);
                let item = {};
                item.name = newValue.name;
                item.price = newValue.price;
                item.restaurant_id = newValue.restaurant_id;
                item.id = key;
                item.quantity = newValue.quantity;
                cartItems.push(item);
            }
            console.log(cartItems);

            appendiCart()
}

function getUserDates(){
    datiUtente.name = userName.value
    datiUtente.surname = userSurname.value
    datiUtente.email = userEmail.value
    datiUtente.address = userAddress.value
    datiUtente.note = userNote.value
    datiUtente.delivery_time = userTime.value
}

getCartItems()

function appendiCart(){

    const box = document.getElementById('info-cart')

    cartItems.forEach((item) => {

        priceTotal += (item.price * item.quantity)
        const div = document.createElement('div')
        div.style.marginBottom = '40px'

        
        div.innerHTML = `
            <div class="name">${item.name}</div>
            <div class="price">Price : ${item.price}&euro;</div>
            <div class="quantity">Quantity ${item.quantity}</div>
            <div class="restaurant_id">Restaurant id ${item.restaurant_id}</div>
            <div class="id">cart_item_id : ${item.id}</div>
            <div class="partial_price">Partial Price : ${item.price * item.quantity}&euro;</div>
        `
        box.append(div)        
    });

    TOT_PRICE.innerHTML = `Prezzo totale : ${priceTotal} &euro;`
}



// fine carrello


    const paySubmit = document.getElementById('payBtn');

    braintree.dropin.create({
        authorization: {!! json_encode($server_token) !!},
        selector: '#dropin-container',
        }, function (err, instance) {
            paySubmit.addEventListener('click', function () {
            instance.requestPaymentMethod(function (err, payload) {
                console.log(payload)

                if(payload){
                    getUserDates()
                    console.log('pagamento avvenuto DIOPORCO')
                    axios.post('api/payment/post', {'paymentMethodNonce': payload.nonce,
                    'transaction': {cartItems},
                    'user_dates': {datiUtente}
                
                })
                    .then((res)=>{
                        console.log(res.data)
                    }).catch((err)=>{
                        console.log(err)
                    })
                }
                });
            })
    })
  </script>
</body>