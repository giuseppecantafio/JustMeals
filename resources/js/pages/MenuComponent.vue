<template>
    <div class="container-fluid">
        <h1 class="text-center mb-5" v-if="restaurant">Menù {{ restaurant.name }}</h1>
        <div class="d-flex justify-content-center gap-3">
            <div class="card w-75 p-5 m-3 gap-3" v-for="(item, index) in menu" :key="index">

                <h5 class="card-title">{{ item.name }}</h5>
                <div class="troncatura card-subtitle text-muted">{{ item.description}}</div>
                <!-- Disponibilità? -->
                <!-- <div>
                    <span>Disponibilità </span>
                    <i v-if="item.available === 1" class="fa-solid fa-circle-check" style="color: green"></i>
                    <i v-else class="fa-solid fa-circle-xmark" style="color: red"></i>
                </div> -->

                <div class="d-flex justify-content-between margine">
                    <div>Prezzo: {{ item.price }} &euro;</div>
                    <button v-if="item.available === 1" @click="addToCart(item)" class="btn text-light rounded-circle" style="background-color: #43abae;">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <button v-else class="btn text-light rounded-circle" style="background-color: #ff7210;">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
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
            // console.log('1--- ',item)
            let check = false;
            if (this.cart.length > 0) {
                // console.log(this.cart);
                // console.log(item);

                this.cart.forEach((element) => {
                    if (element.restaurant_id != item.restaurant_id) {
                        check = true;
                        // console.log("2---######################################################################################");
                        // console.log("3---element: ",
                        //     element.restaurant_id,
                        //     "item: ",
                        //     item.restaurant_id
                        // );
                    }
                });

                if (check) {
                    let destroy = confirm("Svuotare il carrello con l'ordine di un altro ristorante per proseguire?")
                    if(destroy){
                        this.emptyCart()
                        this.cart.push(item);
                        window.localStorage.setItem(`item${this.cart.length}`,JSON.stringify(item));
                    }
                    // console.log('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA')
                } else {
                    // QUI CICLO QUANTITA
                    // CARRELLO NON VUOTO

                    let nuovo = true
                    for (const [key, value] of Object.entries(window.localStorage)) {
                        let parsato = JSON.parse(value)
                      
                        if(parsato.name === item.name){
                                let q = parsato.quantity
                                console.log(key);
                                let vecchiaQuantity = parseInt(key.replace('item', ''))
                                console.log(vecchiaQuantity);
                                window.localStorage.removeItem(key);

                                item.quantity = q + 1
                                window.localStorage.setItem(`item${vecchiaQuantity}`,JSON.stringify(item));

                                nuovo = false

                                return console.log(localStorage)

                        }    
                        
                    }
                    if(nuovo){
                        item.quantity = 1
                        this.cart.push(item);
                        window.localStorage.setItem(`item${this.cart.length}`,JSON.stringify(item));
                        return console.log(localStorage)
                    }
                    // this.cart.push(item);
                    // window.localStorage.setItem(
                    //     `item${this.cart.length}`,
                    //     JSON.stringify(item)
                    // );
                    // console.log("4---?????????????????????????????????????????????????");
                    // console.log('5---',this.cart);
                }
            } else {
                item.quantity = 1
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
                item.quantity = newValue.quantity;
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
        emptyCart() {
            window.localStorage.clear();
            this.cart = [];
        },
    },
    created() {
        this.getMenu();
        this.getCartItems();
    },
    
};
</script>

<style lang="scss" scoped>


.margine{
    margin-top: 20px;
}
.troncatura{
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}
.card{
    box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
}

</style>
