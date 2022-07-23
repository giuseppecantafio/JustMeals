<template>
    <div class="container">
        <!-- <div class="container">
            <div class="row" v-if="cartItems.length > 0">
                <div
                    class="col"
                    v-for="(item, index) in cartItems"
                    :key="index"
                >
                    <div>
                        {{ item.name }}
                    </div>
                    <div>
                        {{ item.price }}
                    </div>
                    <div>
                        {{ item.quantity }}
                    </div>
                    <button @click="removeItem(item.id)">
                        Rimuovi elemento
                    </button>
                </div>
            </div>

            <button @click="emptyCart()">Svuota carrello</button>

             <button class="btn btn-success">
                <a class="text-white" href="/payment">Paga Ora</a>
            </button> -->


            <div class="card m-5" style="">
                <div class="row g-0" v-if="cartItems.length > 0">
                    <button class="btn btn-danger" @click="emptyCart()">Svuota carrello</button>
                    <!-- <div class="col-md-4">
                        <img src="" class="img-fluid rounded-start" alt="...">
                    </div> -->
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
                    <button class="btn btn-success">
                        <a class="text-white" href="/payment">Paga Ora</a>
                    </button>
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
        }
    },
    created() {
        this.getCartItems();
    },
};
</script>

<style lang="scss" scoped></style>
