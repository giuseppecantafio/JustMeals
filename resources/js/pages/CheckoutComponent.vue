<template>
    <div>
        <h1>PORRRRRRRRRCCODDDIOOOOOOOOOOOOO</h1>

        <div v-if="order">{{order.transaction_id}}</div>


        <p>Riceverai una mail di conferma quando il ristoratore accetterà l'ordine</p>
    </div>
</template>

<script>
export default {
    name: 'CheckoutComponent',
    props:{
        order: Object
    },
    data(){
        return{
            transaction: null
        }
    }
}
</script>

<style lang="scss" scoped>

</style>