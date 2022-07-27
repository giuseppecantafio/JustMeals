<template>
    <div>
        <div class="container">
            <div class="row w-75 m-auto">
                <div class="col-12">
                    <!-- ERRORI -->
                    <div v-if="serverErr">
                        Sembra che ci siano problemi con il nostro server. Non ti sarà
                        addebitato nessun costo, riprovare
                    </div>
                    <div v-if="paySuccess">Pagamento avvenuto con successo</div>
                    <div v-if="payFailed">Pagamento rifiutato</div>

                    <!-- riepilogo -->
                    <div class="riepilogo">
                        <h5>Riepilogo</h5>

                        <div id="info-cart" v-if="cartItems.length > 0">
                            <div v-for="item in cartItems" :key="item.id">
                                <h3 class="name">{{ item.name }}</h3>
                                <div class="price">Prezzo: {{ item.price }}&euro;</div>
                                <div class="quantity">Quantità: {{ item.quantity }}</div>
                                <div class="partial_price">
                                    Prezzo parziale:
                                    {{ item.price * item.quantity }}&euro;
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="prezzo" id="total_price">
                                Prezzo totale: &euro;{{ priceTotal }} 
                            </div>

                            <div
                                v-if="discountPrice"
                                class="text-primary my-3"
                                id="total_price"
                            >
                                Vecchio prezzo : {{ oldPrice }} &euro;
                            </div>

                            <div
                                v-if="discountPrice"
                                class="text-danger my-3"
                                id="total_price"
                            >
                                Prezzo scontato : {{ priceTotal }} &euro;
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- form -->
                    <div class="col-12">
                        <form class="dati"
                            v-if="
                                paymentInProgress === false &&
                                oldCustomer === false &&
                                newCustomer === false
                            "
                        >
                            <div class="form-group mb-3">
                                <label for="userName">Nome utente</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="userName"
                                    placeholder="Inserisci il tuo nome"
                                    name="userName"
                                    required
                                />
                            </div>

                            <div class="form-group mb-3">
                                <label for="userSurname">Cognome utente</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="userSurname"
                                    placeholder="Inserisci il tuo cognome"
                                    name="userSurname"
                                    required
                                />
                            </div>

                            <div class="form-group mb-3">
                                <label for="userEmail">Email utente</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="userEmail"
                                    placeholder="Inserisci la tua email"
                                    name="userEmail"
                                    required
                                />
                            </div>

                            <div class="form-group mb-3">
                                <label for="userAddress">Indirizzo utente</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="userAddress"
                                    placeholder="Inserisci la tua via"
                                    name="userAddress"
                                    required
                                />
                            </div>

                            <!-- note  -->
                            <div class="form-group mb-3">
                                <label for="userNote">Note utente</label>
                                <textarea class="form-control" name="userNote" id="userNote"></textarea>
                            </div>

                            <!-- orario -->
                            <div class="form-group mb-3">
                                <label for="delivery">Inserire un orario di consegna</label>
                                <input
                                    class="form-control"
                                    type="time"
                                    id="delivery"
                                    name="delivery"
                                    min="09:00"
                                    max="18:00"
                                    required
                                />
                            </div>
                            <div class="d-flex">
                                <div class="bottone-storto " v-if="!oldCustomer && !newCustomer && !paymentInProgress"
                                @click.prevent="getUserData()"
                                type="submit mycheck">
                                    <div class="btn p-1 pos mycheck" >Invia Dati</div>
                                    <div class="prospettiva">
                                        <div class="storto btn myblue">
                                            <span style="color: transparent;">Invia Dati</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>


            <!-- drop  in -->
            <div id="dropin-container"></div>

            <div v-if="!removePayBtn">
                <button
                    v-if="
                        (oldCustomer || newCustomer) &&
                        paymentInProgress === false
                    "
                    @click.prevent="launchPayment()"
                    class="btn btn-success"
                    type="submit"
                >
                    Vai al pagamento
                </button>

                <!-- button -->
                <button
                    v-show="paymentInProgress"
                    id="payBtn"
                    class="btn btn-success"
                >
                    Pagahh Stronzoooohhhh
                </button>
            </div>


            
        </div>

    </div>
</template>

<script>
export default {
    name: "PaymentComponent",
    data() {
        return {
            server_token: null,
            cartItems: [],
            priceTotal: 0,
            userData: {
                name: "",
                surname: "",
                email: "",
                address: "",
                note: "",
                delivery_time: "",
            },
            newCustomer: false,
            oldCustomer: false,
            paymentInProgress: false,
            discountPrice: false,
            oldPrice: false,
            // transaction: false,
            // transactionInstance: null,
            // order: '',
            orderDetails: null,
            serverErr: false,
            paySuccess: false,
            payFailed: false,
            removePayBtn: false,
        };
    },
    created() {
        this.callForToken();
    },
    mounted() {
        this.getCartItems();
    },
    methods: {
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

                this.cartItems.push(item);

                this.priceTotal += item.price * item.quantity;
            }
        },
        // per ora in mounted, ma spostare a dopo submit form
        callForToken() {
            axios
                .get("/token")
                .then((res) => {
                    if (typeof res.data === "string") {
                        this.server_token = res.data;
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        // dopo submit form utente
        getUserData() {
            const userName = document.getElementById("userName");
            const userSurname = document.getElementById("userSurname");
            const userEmail = document.getElementById("userEmail");
            const userAddress = document.getElementById("userAddress");
            const userNote = document.getElementById("userNote");
            const userTime = document.getElementById("delivery");

            this.userData.name = userName.value;
            this.userData.surname = userSurname.value;
            this.userData.email = userEmail.value;
            this.userData.address = userAddress.value;
            this.userData.note = userNote.value;
            this.userData.delivery_time = userTime.value;

            // QUI FARE CHIAMATA API PER CONTROLLO USER E SCONTO
            axios
                .post("api/payment/checkuser", this.userData)
                .then((res) => {
                    console.log(res.data);
                    if (res.data === "new") {
                        // - se nuovo utente fai launchpayment
                        this.newCustomer = true;
                    } else if (res.data === "wrong") {
                        //  - se email già esistente dire di cambiarla
                        return alert(
                            "La tua email è già presente sotto un altro nome. Metti una mail valida"
                        );
                    } else if (res.data === "old") {
                        //  - se utente già esistente applica sconto e mostra botton paga ora
                        this.oldCustomer = true;
                        this.oldPrice = this.priceTotal.toFixed(2);
                        this.discountPrice = true;
                        this.priceTotal = (this.priceTotal * 0.8).toFixed(2);
                        return alert(
                            "Bentornato utente! Lo sconto del 20% sarà applicato al tuo carrello"
                        );
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        launchPayment() {
            const paySubmit = document.getElementById("payBtn");

            if (this.server_token) {
                braintree.dropin
                    .create({
                        authorization: this.server_token,
                        selector: "#dropin-container",
                    })
                    .then((instance) => {
                        this.paymentInstance = instance;
                        // console.log('this payment instance ---- ',this.paymentInstance)
                        this.paymentInProgress = true;
                        paySubmit.addEventListener(
                            "click",
                            this.instancePayment
                        );
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            } else {
                alert("non c'è il token");
            }
        },
        instancePayment() {
            this.removePayBtn = true;
            const userData = this.userData;
            const items = this.cartItems;
            const totalPrice = this.priceTotal;
            this.paymentInProgress = false;
            let customer;
            if (this.oldCustomer === true) {
                customer = "old";
            } else if (this.newCustomer === true) {
                customer = "new";
            }

            console.log(this.paymentInstance.requestPaymentMethod);

            this.paymentInstance.requestPaymentMethod().then((payload) => {
                axios
                    .post("api/payment/post", {
                        paymentMethodNonce: payload.nonce,
                        transaction: { items },
                        user_dates: { userData },
                        total_price: parseFloat(totalPrice).toFixed(2),
                        customer: customer,
                    })
                    .then((result) => {
                        console.log("result: ", result);

                        let orderDetails = {
                            items: items,
                            userData: userData,
                            total_price: parseFloat(totalPrice).toFixed(2),
                            customer: customer,
                            transaction_id: result.data.transaction.id,
                        };

                        this.orderDetails = orderDetails;

                        console.log(this.orderDetails);

                        window.localStorage.clear();

                        // butto giù la finestra
                        this.paymentInstance.teardown(function (teardownErr) {
                            if (teardownErr) {
                                console.error(
                                    "Could not tear down Drop-in UI!"
                                );
                                console.log("RESULT----", result);
                            } else {
                                console.info("Drop-in UI has been torn down!");
                                console.log("RESULT ELSE----", result);
                            }
                        });

                        if (result.data.success) {
                            this.paySuccess = true;
                            setTimeout(() => {
                                this.$router.push({
                                    name: "checkout",
                                    params: {
                                        id: result.data.transaction.id,
                                        order: this.orderDetails,
                                    },
                                });
                            }, 2500);
                        } else {
                            this.payFailed = true;
                        }
                    })
                    .catch((err) => {
                        console.log("error: ", err);
                        this.serverErr = true;
                    });
            });
        },
    },
};
</script>

<style lang="scss" scoped>
@import '../../sass/front.scss';

.bottone{
    background-color: #0d9ca4;
}
.riepilogo{
    background-color: $my-white;
    padding: 30px;
    border-radius: 20px;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    margin-bottom: 50px;
}
.prezzo{
    display: flex;
    font-weight: 700;
    font-size: 20px;
    padding-top: 20px;
    justify-content: flex-end;
}
#info-cart{
    padding-bottom: 5px;
    border-bottom: 1px solid rgb(192, 192, 192);
}
.dati{
    background-color: $my-white;
    padding: 30px;
    border-radius: 20px;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    margin-bottom: 50px;
}
.prospettiva{
    perspective: 100px;
}
.storto{
    transform: rotateY(-9deg) rotateX(-11deg) rotateZ(-1deg) translateX(-8px);
    transition: transform 0.5s;
    padding: 12px !important;
}
.storto:hover{
    transform: none;
}
.pos{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.bottone-storto{
    position: relative;
}
.myblue{
    border: 1px solid $my-blue;
}
.mycheck{
    color: $my-blue;
}
</style>
