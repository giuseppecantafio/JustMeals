<template>
    <div>
        <div class="container">
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
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "CartComponent",
    data() {
        return {
            cartItems: [],
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
        }
    },
    created() {
        this.getCartItems();
    },
};
</script>

<style lang="scss" scoped></style>
