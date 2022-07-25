<template>
    <div>

        <h1>Payment Component</h1>

        <div class="container">

            <!-- riepilogo -->
            <div class="riepilogo">

                    <h2>Riepilogo</h2>

                    <div id="info-cart" v-if="cartItems.length > 0">

                            <div class="card" v-for="item in cartItems" :key="item.id">

                                <div class="name">{{item.name}}</div>
                                <div class="price">Price : {{item.price}}&euro;</div>
                                <div class="quantity">Quantity {{item.quantity}}</div>
                                <div class="restaurant_id">Restaurant id {{item.restaurant_id}}</div>
                                <div class="id">cart_item_id : {{item.id}}</div>
                                <div class="partial_price">Partial Price : {{item.price * item.quantity}}&euro;</div>

                            </div>

                    </div>

                    <div>

                        <div class="text-primary my-3" id="total_price">Prezzo totale : {{priceTotal}} &euro;</div>

                        <div v-if="discountPrice" class="text-primary my-3" id="total_price">Vecchio prezzo : {{oldPrice}} &euro;</div>

                        <div v-if="discountPrice" class="text-danger my-3" id="total_price">Prezzo scontato : {{priceTotal}} &euro;</div>
                    </div>

            </div>


            <!-- form -->

            <form v-if="paymentInProgress === false && oldCustomer === false && newCustomer === false">

            <h2>DATI UTENTE</h2>
        
            <div class="form-group mb-3">
                <label for="userName">Nome utente</label>
                <input type="text" class="form-control" id="userName" placeholder="Inserisci il tuo nome" name="userName" required>
            </div>
        
            <div class="form-group mb-3">
                <label for="userSurname">Cognome utente</label>
                <input type="text" class="form-control" id="userSurname" placeholder="Inserisci il tuo cognome" name="userSurname"  required>
            </div>
        
            <div class="form-group mb-3">
                <label for="userEmail">Email utente</label>
                <input type="email" class="form-control" id="userEmail" placeholder="Inserisci la tua email" name="userEmail"  required>
            </div>
        
            <div class="form-group mb-3">
                <label for="userAddress">Indirizzo utente</label>
                <input type="text" class="form-control" id="userAddress" placeholder="Inserisci la tua via" name="userAddress"  required>
            </div>
        
            <!-- note  -->
            <div class="form-group mb-3">
                <label for="userNote">Note utente</label>
                <textarea name="userNote" id="userNote" ></textarea>
            </div>

            <!-- orario -->
            <div class="form-group mb-3">
                <label for="delivery">Inserire un orario di consegna</label>
                <input type="time" id="delivery" name="delivery"
                    min="09:00" max="18:00"  required>
            </div>

        </form>
        
        <button v-if="(oldCustomer || newCustomer) && paymentInProgress === false" @click.prevent="launchPayment()" class="btn btn-success" type="submit">Vai al pagamento</button>

        <button v-if="!oldCustomer && !newCustomer && !paymentInProgress" @click.prevent="getUserData()" class="btn btn-success" type="submit">Invia Dati</button>

        <!-- drop  in -->
        <div id="dropin-container"></div>

        <div id="result"></div>


        <!-- button -->
        <button v-show="paymentInProgress" id="payBtn" class="btn btn-success">Pagahh Stronzoooohhhh</button>
    
    </div>

    </div>
</template>

<script>
export default {
    name: 'PaymentComponent',
    data(){
        return{
            server_token: null,
            cartItems: [],
            priceTotal: 0,
            userData: {
                name : '',
                surname : '',
                email : '',
                address : '',
                note : '',
                delivery_time: ''
            },
            newCustomer: false,
            oldCustomer: false,
            paymentInProgress: false,
            discountPrice: false,
            oldPrice: false,
            transaction: false
        }
    },
    created(){
        this.callForToken()
    },
    mounted(){
        this.getCartItems()
    },
    methods:{
        // in mounted
        getCartItems() {
            for (const [key, value] of Object.entries(window.localStorage)) {
                let newValue = JSON.parse(value);
                let item = {};
                item.name = newValue.name;
                item.price = newValue.price;
                item.restaurant_id = newValue.restaurant_id;
                item.id = key;
                item.quantity = newValue.quantity;
                
                this.cartItems.push(item)

                this.priceTotal += (item.price * item.quantity)
            }
        },
        // per ora in mounted, ma spostare a dopo submit form
        callForToken(){
            axios.get('/token').then((res)=>{
                if(typeof res.data === 'string'){
                    this.server_token = res.data;
                }
            }).catch((error) => {
                console.log(error)
            })
        },
        // dopo submit form utente
        getUserData(){
            const userName = document.getElementById('userName')
            const userSurname = document.getElementById('userSurname')
            const userEmail = document.getElementById('userEmail')
            const userAddress = document.getElementById('userAddress')
            const userNote = document.getElementById('userNote')
            const userTime = document.getElementById('delivery')

            this.userData.name = userName.value
            this.userData.surname = userSurname.value
            this.userData.email = userEmail.value
            this.userData.address = userAddress.value
            this.userData.note = userNote.value
            this.userData.delivery_time = userTime.value

            // QUI FARE CHIAMATA API PER CONTROLLO USER E SCONTO
            axios.post('api/payment/checkuser', this.userData)
            .then((res)=>{
                console.log(res.data)
                if(res.data === 'new'){
                    // - se nuovo utente fai launchpayment
                    this.newCustomer = true
                } else if(res.data === 'wrong'){
                    //  - se email già esistente dire di cambiarla
                    return alert("La tua email è già presente sotto un altro nome. Metti una mail valida")
                } else if(res.data === 'old'){
                    //  - se utente già esistente applica sconto e mostra botton paga ora
                    this.oldCustomer = true
                    this.oldPrice = this.priceTotal.toFixed(2)
                    this.discountPrice = true
                    this.priceTotal = (this.priceTotal * 0.8).toFixed(2)
                    return alert('Bentornato utente! Lo sconto del 20% sarà applicato al tuo carrello')
                }
            }).catch((error)=>{
                console.log(error)
            })
 
            
        },
        launchPayment(){

            this.paymentInProgress = true

            const userData = this.userData
            const items = this.cartItems
            const totalPrice = this.priceTotal

            let customer;
            if(this.oldCustomer === true){
                customer = 'old'
            } else if(this.newCustomer === true){
                customer = 'new'
            }

            
            const paySubmit = document.getElementById('payBtn');

            if(this.server_token){
                
                braintree.dropin.create({
                    authorization: this.server_token,
                    selector: '#dropin-container',
                    }, function (err, instance) {
    
                            paySubmit.addEventListener('click', function () {
                            instance.requestPaymentMethod(function (err, payload) {
                                if(payload){
                                    axios
                                    .post('api/payment/post', {'paymentMethodNonce': payload.nonce,
                                    'transaction': { items },
                                    'user_dates': { userData },
                                    'total_price' : parseFloat(totalPrice).toFixed(2),
                                    'customer': customer
                                    })
                                    .then((result)=> {
                                        const div = document.getElementById('result')
                                        let cazzo = result.data.transaction.id
                                        div.append(cazzo)


                                        console.log('ANTONELLO TI AMO')
                                        console.log(result)

                                        // this.transaction = result.data
                                        // console.log(this.transaction)
                                            // Tear down the Drop-in UI
                                        //    console.log('prima di result ',result)
                                            instance.teardown(function (teardownErr) {
                                                if (teardownErr) {
                                                console.error('Could not tear down Drop-in UI!');
                                                 console.log('RESULT----',result)
                                                } else {
                                                    // window.location.replace("/checkout");
                                                console.info('Drop-in UI has been torn down!');
                                                console.log('RESULT ELSE----',result)
                                                // Remove the 'Submit payment' button
                                                // $('#submit-button').remove();
                                                }
                                            });
    
                                            // if (result.success) {
                                            //   // $('#checkout-message').html('<h1>Success</h1><p>Your Drop-in UI is working! Check your <a href="https://sandbox.braintreegateway.com/login">sandbox Control Panel</a> for your test transactions.</p><p>Refresh to try another transaction.</p>');
                                            //   console.log('successo',result);
                                            // } else {
                                            //   console.log('result else',result);
                                            //   // $('#checkout-message').html('<h1>Error</h1><p>Check your console.</p>');
                                            // }
                                        })
                                    // .then((res)=>{
                                    //     console.log('res',res.data)
                                    // }).catch((err)=>{
                                    //     console.log(err)
                                    // })
                                } else {
                                console.log('error',err);
                                }
                                })         
                            })
                    })
            }

        }
    }
    
}
</script>

<style lang="scss" scoped>

</style>