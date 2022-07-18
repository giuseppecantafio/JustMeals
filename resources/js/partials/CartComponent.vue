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
                    <button @click="removeItem(item.id)">Rimuovi elemento</button>
                </div>
            </div>

            <button @click="emptyCart()">Svuota carrello</button>
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
                console.log(key)
                item.id = key;
                this.cartItems.push(item);
            }
        },
        emptyCart(){
            window.localStorage.clear();
            this.cartItems = [];
        },
        removeItem(id){
            window.localStorage.removeItem(id);

            this.cartItems.forEach((item)=>{
                if(item.id === id){
                    this.cartItems.splice(item)
                }
            })
            
            this.getCartItems()
        }

    },
    created() {
        this.getCartItems();
    },
};
</script>

<style lang="scss" scoped></style>
