<template>
    <div class="container">

            <div class="form-check" v-for="typology in typologies" :key="typology.id" >
                <input class="form-check-input" type="checkbox" :value="typology.id" @change="filterRestaurants()" id="flexCheckDefault" v-model="selectTypo">
                <label class="form-check-label" for="flexCheckDefault">
                    {{typology.name}}
                </label>
            </div>

            <div class="row d-flex" style="flex-direction: row">
                <div class="col" v-for="restaurant in restaurants" :key="restaurant.id" style="padding-bottom: 30px">
                    <div  class="card" style="height: 100%">
                        <img :src="`/storage/${restaurant.image}`" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{restaurant.name}}</h5>
                            <h6 class="card-subtitle">{{restaurant.address}}</h6>
                            <p class="card-text">{{restaurant.vat}}</p>
                            <div v-if="(restaurant.typologies)">
                                <p v-for="typology in restaurant.typologies" :key="typology.id" class="card-text">{{typology.name}}</p>

                            </div>
                        </div>
                        <button class="btn btn-primary">
                            <router-link :to="{ name: 'menu', params: { slug: restaurant.slug } }" style="color:white" >Menu</router-link>
                        </button>
                    </div>
                </div>
            </div>
    </div>
</template>

<script>
export default {
    name: "RestaurantsComponent",
    data() {
        return {
            restaurants: [],
            typologies: [],
            selectTypo: [],
            apiPath: 'api/restaurants'
        }
    },
    methods: {
        getApiTypologies() {

            axios.get("api/typologies")
                .then((response) => {
                    this.typologies = response.data;
                    // this.filterRestaurants();
                })
                .catch((error) => {
                    console.log('1---',error);
                });
        },
        filterRestaurants(){

            if (this.selectTypo.length > 0){

                let finalQuery = '';
                this.selectTypo.forEach((el) =>{
                    finalQuery += (el + ',')
                });
                    
                axios.get(`${this.apiPath}?typology=${finalQuery}`)
                    .then((response)=>{
                        this.restaurants = response.data;
                        // console.log('3---',this.selectTypo);
                    }).catch((error)=>{
                        console.log(error);
                    });
            } else {
                // console.log('SONO QUI')
                axios.get(this.apiPath)
                    .then((response)=>{
                        // console.log('5,1---',response.data)
                        this.restaurants = response.data;
                        // console.log('5---',this.restaurants)
                    }).catch((error)=>{
                        console.log(error);
                    });
            }
        }
    },
    created(){
        this.getApiTypologies();
        this.filterRestaurants();
    },
};
</script>

<style lang="scss" scoped></style>
