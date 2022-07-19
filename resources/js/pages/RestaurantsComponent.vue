<template>
<div class="container">

    <!-- <select name="filterTypologies" id="filterTypologies" v-model="selectTypo" @change="filterRestaurants(selectTypo)">
        <option value="">Select typology</option>

        <option v-for="typology in typologies" :key="typology.id" :value="typology.id">{{typology.name}}</option>
    </select> -->

    <div class="form-check" v-for="typology in typologies" :key="typology.id" >
        <input class="form-check-input" type="checkbox" :value="typology.id" @change="filterRestaurants(selectTypo)" id="flexCheckDefault" v-model="selectTypo">
        <label class="form-check-label" for="flexCheckDefault">
            {{typology.name}}
        </label>
    </div>

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
</div>
</template>

<script>
export default {
    name: 'RestaurantsComponent',
    data(){
        return{
            restaurants: [],
            typologies: [],
            selectTypo: [],
        }
    },
    methods: {
        getApiTypologies(){
            axios.get("api/typologies").then((response)=>{
                this.typologies = response.data;
                console.log(this.typologies)
            }).catch((error)=>{
                console.log(error);
            });
        },
        filterRestaurants(query){
            console.log(query)
            if (this.selectTypo.length > 0){
                    axios.get(`api/restaurants?id=${query}`).then((response)=>{
                        this.restaurants = response.data;
                        console.log(this.selectTypo);
                }).catch((error)=>{
                    console.log(error);
                });
            } else {
                    axios.get("api/restaurants").then((response)=>{
                        this.restaurants = response.data;
                        //console.log(this.restaurants)
                }).catch((error)=>{
                    console.log(error);
                });
            }

        }
    },
    created(){
        this.filterRestaurants();
        // axios.get("api/typologies").then((response)=>{
        //     this.typologies = response.data;
        //     console.log(this.typologies)
        // }).catch((error)=>{
        //     console.log(error);
        // });
        // axios.get("api/restaurants?id=1").then((response)=>{
        //     this.restaurants = response.data;
        //     console.log(this.restaurants);
        // }).catch((error)=>{
        //     console.log(error);
        // });
        this.getApiTypologies()
    }
}
</script>

<style lang="scss" scoped>

</style>