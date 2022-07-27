<template>
    <div class="checkout w-75 m-auto">
        <div class="check"></div>
        <h1 class="titolo my-3">Grazie per il tuo ordine!</h1>

        <div class="text-center" v-if="order">Riceverai una mail di conferma quando il ristoratore accetterà l'ordine n° <strong>{{order.transaction_id}}</strong> </div>
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
@import '../../sass/front.scss';

.checkout{
    background-color: $my-white;
    padding: 30px;
    border-radius: 20px;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    margin-bottom: 50px;

}
.check{
    transform: rotate(45deg);
    height: 24px;
    width: 12px;
    border-bottom: 7px solid #78b13f;
    border-right: 7px solid #78b13f;
    margin: auto;
    text-align: center;
}
.titolo{
    padding-top: 15px;
}
</style>