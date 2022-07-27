<template>
    <div class="container">
        
        <div class="card m-5" style="">
            <div class="row g-0" v-if="cartItems.length > 0">

                <button class="btn btn-danger" @click="emptyCart()">Svuota carrello</button>
                
                <div class="col-md-8"  v-for="(item, index) in cartItems" :key="index">
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
        </div>
        </div>
</template>

<script>
export default {
    name: "CartComponent",
    data() {
        return {
            cartItems: [],
            token: null
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



</style>
