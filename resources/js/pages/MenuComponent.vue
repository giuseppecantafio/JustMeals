<template>
    <div>
        <div class="d-flex justify-content-between">
            <h1 v-if="restaurant">Menù {{ restaurant.name }}</h1>
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
    name: "MenuComponent",
    data() {
        return {
            menu: [],
            cart: [],
            restaurant: {},
        };
    },
    methods: {
        addToCart(item) {
            console.log('1--- ',item)
            if (this.cart.length > 0) {
                // console.log(this.cart);
                // console.log(item);
                let cheeck = false;
                this.cart.forEach((element) => {
                    if (element.restaurant_id != item.restaurant_id) {
                        cheeck = true;
                        console.log(
                            "2---######################################################################################"
                        );
                        console.log(
                            "3---element: ",
                            element.restaurant_id,
                            "item: ",
                            item.restaurant_id
                        );
                    }
                });
                if (cheeck) {
                    alert('PORCAMADONNA')
                    console.log('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA')
                } else {
                    this.cart.push(item);
                    window.localStorage.setItem(
                        `item${this.cart.length}`,
                        JSON.stringify(item)
                    );
                    console.log(
                        "4---?????????????????????????????????????????????????"
                    );
                    console.log('5---',this.cart);
                }
            } else {
                this.cart.push(item);
                window.localStorage.setItem(
                    `item${this.cart.length}`,
                    JSON.stringify(item)
                );
                console.log('6---',this.cart);
            }
        },
        getCartItems() {
            for (const [key, value] of Object.entries(window.localStorage)) {
                let newValue = JSON.parse(value);
                let item = {};
                item.name = newValue.name;
                item.price = newValue.price;
                item.restaurant_id = newValue.restaurant_id;
                item.id = key;
                this.cart.push(item);
            }
        },
        getMenu() {
            const slug = this.$route.params.slug;
            axios
                .get(`/api/restaurants/${slug}`)
                .then((response) => {
                    this.menu = response.data.items;
                    this.restaurant = response.data;
                    console.log("7---RESTAURANT : ", response.data);
                })
                .catch((error) => {
                    console.log('8---',error);
                });
        },
    },
    created() {
        this.getMenu();
        this.getCartItems();
    },
};
</script>

<style lang="scss" scoped></style>
