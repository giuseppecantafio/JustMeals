<template>
<div>      
    <div class="position-fixed">
        <div class="m-3">
            <i class="fa-solid fa-utensils"></i>
            Tutte le categorie:
        </div>
        <div class="form-check" v-for="typology in typologies" :key="typology.id" >
            <label class="checkbox path">
                <input class="form-check-input" type="checkbox" :value="typology.id" @change="filterRestaurants()" id="flexCheckDefault" v-model="selectTypo">
                <svg viewBox="0 0 21 21">
                    <path d="M5,10.75 L8.5,14.25 L19.4,2.3 C18.8333333,1.43333333 18.0333333,1 17,1 L4,1 C2.35,1 1,2.35 1,4 L1,17 C1,18.65 2.35,20 4,20 L17,20 C18.65,20 20,18.65 20,17 L20,7.99769186"></path>
                </svg>
                <label class="form-check-label px-1" for="flexCheckDefault">
                    {{typology.name}}
                </label>
            </label>
        </div>
    </div>
    <div class="container">
            <div class="row d-flex" style="flex-direction: row">
                <div class="col" v-for="restaurant in restaurants" :key="restaurant.id" style="padding-bottom: 30px">
                    <div  class="card" style="height: 100%">
                        <img :src="`/storage/${restaurant.image}`" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{restaurant.name}}</h5>
                            <h6 v-if="restaurant.user">di {{restaurant.user.name}} {{restaurant.user.surname}}</h6>
                            <h6 class="card-subtitle mt-2">{{restaurant.address}}</h6>
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
                        console.log('5,1---',response.data)
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

<style lang="scss" scoped>



.checkbox {
    --background: #fff;
    --border: #D1D6EE;
    --border-hover: #BBC1E1;
    --border-active: #1E2235;
    --tick: #fff;
    position: relative;
    input,
    svg {
        width: 21px;
        height: 21px;
        display: block;
    }
    input {
        -webkit-appearance: none;
        -moz-appearance: none;
        position: relative;
        outline: none;
        background: var(--background);
        border: none;
        margin: 0;
        padding: 0;
        cursor: pointer;
        border-radius: 4px;
        transition: box-shadow .3s;
        box-shadow: inset 0 0 0 var(--s, 1px) var(--b, var(--border));
        &:hover {
            --s: 2px;
            --b: var(--border-hover);
        }
        &:checked {
            --b: var(--border-active);
        }
    }
    svg {
        pointer-events: none;
        fill: none;
        stroke-width: 2px;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke: var(--stroke, var(--border-active));
        position: absolute;
        top: 0;
        left: 0;
        width: 21px;
        height: 21px;
        transform: scale(var(--scale, 1)) translateZ(0);
    }
    &.path {
        input {
            &:checked {
                --s: 2px;
                transition-delay: .4s;
                & + svg {
                    --a: 16.1 86.12;
                    --o: 102.22;
                }
            }
        }
        svg {
            stroke-dasharray: var(--a, 86.12);
            stroke-dashoffset: var(--o, 86.12);
            transition: stroke-dasharray .6s, stroke-dashoffset .6s;
        }
    }
    &.bounce {
        --stroke: var(--tick);
        input {
            &:checked {
                --s: 11px;
                & + svg {
                    animation: bounce .4s linear forwards .2s;
                }
            }
        }
        svg {
            --scale: 0;
        }
    }
}

@keyframes bounce {
    50% {
        transform: scale(1.2);
    }
    75% {
        transform: scale(.9);
    }
    100% {
        transform: scale(1);
    }
}


</style>
