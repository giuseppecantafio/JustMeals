<template>
    <div>
        <h1>PORRRRRRRRRCCODDDIOOOOOOOOOOOOO</h1>

        <h3 v-if="transaction">{{transaction.transaction_id}}</h3>


        <p>Riceverai una mail di conferma quando il ristoratore accetterà l'ordine</p>
    </div>
</template>

<script>
export default {
    name: 'CheckoutComponent',
    data(){
        return{
            transaction: null
        }
    },
    methods:{
        getOrderDetails(){
            console.log(window.localStorage)
            let result = JSON.parse(window.localStorage['result'])
            this.transaction = result

            console.log(result)
        }
    },
    mounted(){
        this.getOrderDetails()
    },
    beforeDestroy(){
        window.localStorage.clear()
    }
}
</script>

<style lang="scss" scoped>

</style>