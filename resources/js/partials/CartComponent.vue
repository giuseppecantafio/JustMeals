<template>
    <div>
        <div class="container">
            <div class="row">
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
        };
    },
    methods: {
        getCartItems() {
            for (const [key, value] of Object.entries(window.localStorage)) {
                let newValue = JSON.parse(value);
                let item = {};
                item.name = newValue.name;
                item.price = newValue.price;
                this.cartItems.push(item);
            }
            // console.log(this.getCart[0].name, this.getCart[0].price);
        },
    },
    created() {
        this.getCartItems();
    },
};
</script>

<style lang="scss" scoped></style>
