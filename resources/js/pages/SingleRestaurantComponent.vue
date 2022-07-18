<template>
    <div>
        <h1>Benvenuto da Pizzeria da Clelia</h1>
        <cart-component :piatto="'leonardo'" />
        <div class="d-flex justify-content-between">
            <div class="card" v-for="(item, index) in menu" :key="index">
                <div>
                    {{ item.name }}
                </div>
                <div>
                    {{ item.price }}
                </div>
                <button @click="addToCart(item)" class="btn btn-primary">
                    Aggiungi al carrello
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import CartComponent from "../partials/CartComponent.vue";

export default {
    components: { CartComponent },
    name: "SingleRestaurantComponent",
    data() {
        return {
            menu: [
                {
                    name: "Pizza leonardiana",
                    price: 340,
                },
                {
                    name: "Pizza clelia",
                    price: 10,
                },
                {
                    name: "Pizza ciao",
                    price: 24,
                },
                {
                    name: "Pizza Dennis boss",
                    price: 69,
                },
                {
                    name: "Pizza Antonio",
                    price: 69,
                },
                {
                    name: "Pizza Gabriel",
                    price: 69,
                },
                {
                    name: "Pizza Peppe",
                    price: 69,
                },
            ],
            cart: [],
        };
    },
    methods: {
        addToCart(item) {
            this.cart.push(item);
            window.localStorage.setItem(
                `item${this.cart.length}`,
                JSON.stringify(item)
            );

            console.log("PORCOLEONAROD");
        },
    },
};
</script>

<style lang="scss" scoped></style>
