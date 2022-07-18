<template>
    <div>
        <h1>Benvenuto da Pizzeria da Clelia</h1>
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

export default {

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

            console.log(this.cart);
        },
        getCartItems() {
            for (const [key, value] of Object.entries(window.localStorage)) {
                let newValue = JSON.parse(value);
                let item = {};
                item.name = newValue.name;
                item.price = newValue.price;
                this.cart.push(item);
            }
        },
    
    },
    mounted(){
        console.log('Cart : ',this.cart)
    },
    created(){
        this.getCartItems()
    }
}


</script>

<style lang="scss" scoped>

</style>
