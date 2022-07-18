<template>
<div class="d-flex">
    <div v-for="restaurant in restaurants" :key="restaurant.id" class="card" style="width: 18rem;">
        <img :src="`/storage/${restaurant.image}`" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{restaurant.name}}</h5>
            <h6 class="card-subtitle">{{restaurant.address}}</h6>
            <p class="card-text">{{restaurant.vat}}</p>
            <div v-if="(restaurant.typologies)">
                <p v-for="typology in restaurant.typologies" :key="typology.id" class="card-text">{{typology.name}}</p>
            </div>
            <router-link class="btn btn-primary" :to="{ name: 'menu', params: {slug: restaurant.slug} }">Vai al menù</router-link>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'RestaurantsComponent',
    data(){
        return{
            restaurants: [],
            typologies: [],
        }
    },
    created(){
        axios.get("api/restaurants").then((response)=>{
            this.restaurants = response.data;
            //console.log(this.restaurants)
        }).catch((error)=>{
            console.log(error);
        });
        axios.get("api/typologies").then((response)=>{
            this.typologies = response.data;
            console.log(this.typologies)
        }).catch((error)=>{
            console.log(error);
        });
        axios.get("api/restaurants?id=1").then((response)=>{
            this.restaurants = response.data;
            console.log(this.restaurants);
        }).catch((error)=>{
            console.log(error);
        });
    }
}
</script>

<style lang="scss" scoped>

</style>