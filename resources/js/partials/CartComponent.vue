<template>
    <!-- <div class="container">
            <div class="row" v-if="cartItems.length > 0">
                <button class="btn btn-danger" @click="emptyCart()">Svuota carrello</button>
                
                <div class=""  v-for="(item, index) in cartItems" :key="index">
                    <div class="card-body">
                        <h5 class="card-title">{{ item.name }}</h5>
                        <p class="card-text">Descrizione: {{ item.description }}</p>
                        <p class="card-text"><small class="text-muted">Quantità: {{ item.quantity }}</small></p>
                        

                        <button class="btn btn-primary" @click="removeItem(item.id)">
                            Rimuovi elemento
                        </button>
                    </div>
                </div>
                <router-link :to="{ name : 'payment' }" class="btn btn-success">Vai al pagamento</router-link>

            </div>
        </div> -->
        <div>
                <div class="text-center container bgcontenitore" v-if="cartItems.length < 1">
                    Il tuo carrello è vuoto.
                </div>
            <div class="container bgcontenitore" v-if="cartItems.length > 0">
                <div class="top">
                    <h5>Shopping cart</h5>
                    <!-- <button class="btn removebtn" @click="emptyCart()">Svuota carrello</button> -->
                    <div class="d-flex">
                        <div class="bottone-storto" @click="emptyCart()">
                        <div class="btn p-1 pos text-danger" >Svuota carrello</div>
                        <div class="prospettiva">
                            <router-link class="storto btn"  style="border: 1px solid red" :to="{ name: 'cart' }">
                                <span style="color: transparent;">Svuota carrello</span>
                            </router-link>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="bottom">
                    <div class="bottomcontainer" v-for="(item, index) in cartItems" :key="index">
                        <div>
                            <h3 class="">{{ item.name }}</h3>
                            <p class="">Descrizione: {{ item.description }}</p>
                            <p class="">Quantità: {{ item.quantity }}</p>
                        </div>
                        <div class="pricecontainer">
                            <p class="prezzo">&euro;{{ item.price * item.quantity }}</p>
                            <button class="btn removebtn" @click="removeItem(item.id)">
                                Rimuovi
                            </button>
                        </div>
                    </div>
                </div>
                <div class="checkout">
                    <p class="prezzo">Subtotal: &euro;{{totalPrice}}</p>
                    <!-- <router-link :to="{ name : 'payment' }" class="">Vai al pagamento</router-link> -->
                    <div class="d-flex">
                        <div class="bottone-storto">
                        <div class="btn p-1 pos mycheck">Checkout</div>
                        <div class="prospettiva">
                            <router-link class="storto btn myblue" :to="{ name: 'payment' }">
                                <span style="color: transparent;">Checkout</span>
                            </router-link>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
export default {
    name: "CartComponent",
    data() {
        return {
            cartItems: [],
            token: null,
            totalPrice: 0,
        };
    },
    methods: {
        getCartItems() {
            for (const [key, value] of Object.entries(window.localStorage)) {
                let newValue = JSON.parse(value);
                let item = {};
                item.name = newValue.name;
                item.price = newValue.price;
                item.restaurant_id = newValue.restaurant_id;
                item.description = newValue.description;
                item.quantity = newValue.quantity;
                this.totalPrice += item.price * item.quantity;
                item.totalPrice = newValue.totalPrice;
                item.id = key;
                this.cartItems.push(item);
            }
            console.log(this.cartItems);
        },
        emptyCart() {
            window.localStorage.clear();
            this.cartItems = [];
        },
        removeItem(id) {
            window.localStorage.removeItem(id);

            this.cartItems.forEach((item) => {
                if (item.id === id) {
                    this.cartItems.splice(item);
                }
            });

            this.getCartItems();
        },
        checkAndGo(){
            if(this.token){
                this.$router.push({name: 'payment', params: { token: this.token } })
            }
        },
    },
    created() {
        this.getCartItems();

        console.log('storage : ',window.localStorage)
    },
};
</script>

<style lang="scss" scoped>
@import '../../sass/front.scss';


.bgcontenitore{
    background-color: $my-white;
    padding: 30px;
    border-radius: 20px;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
}
.top{
    display: flex;
    justify-content: space-between;
    padding-bottom: 20px;
}
.bottom{
    border-bottom: 1px solid rgb(192, 192, 192);
}
.bottomcontainer{
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.prezzo{
    font-weight: 700;
    font-size: 20px;
    padding-top: 20px;
}
.removebtn{
    text-decoration: underline;
    color: red;
    padding: 0;
    &:hover{
        text-decoration: none;
        color: red;
    }
}
.pricecontainer{
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}
.checkout{
    display: flex;
    /* justify-content: flex-end; */
    flex-direction: column;
    align-items: flex-end;
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
