<template>
    <div>
        <div class="container">
            <span class="titolo-carosello">le nostre pizzerie</span>
            <i class="fa-solid fa-pizza-slice"></i>
            <VueSlickCarousel :arrows="true" :dots="true" v-bind="settings" v-if="ok">
                <div v-for="pizzeria in pizzerie" :key="pizzeria.id">
                    <div class="card" style="width: 18rem;">
                        <img :src="`/storage/${pizzeria.image}`" class="card-img" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{pizzeria.name}}</h5>
                            <button class="btn btn-primary">
                                <router-link :to="{ name: 'menu', params: { slug: pizzeria.slug } }" style="color:white" >vai al Menu</router-link>
                            </button>
                        </div>
                    </div>
                </div>
            </VueSlickCarousel>
        </div>
        <div class="container py-3">
            <span class="titolo-carosello">i nostri ristoranti giapponesi</span>
            <i class="fa-solid fa-fish"></i>
            <VueSlickCarousel :arrows="true" :dots="true" v-bind="settings" v-if="ko">
                <div v-for="giappo in giapponesi" :key="giappo.id">
                    <div class="card" style="width: 18rem;">
                        <img :src="`/storage/${giappo.image}`" class="card-img" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{giappo.name}}</h5>
                            <button class="btn btn-primary">
                                <router-link :to="{ name: 'menu', params: { slug: giappo.slug } }" style="color:white" >vai al Menu</router-link>
                            </button>
                        </div>
                    </div>
                </div>
            </VueSlickCarousel>
        </div>
    </div>
</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
  // optional style for arrows & dots
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'


export default {
    components: {},
    name: "HomeComponent",
    components: { VueSlickCarousel },
    data(){
        return{
            settings:{
                "dots": true,
                "focusOnSelect": true,
                "infinite": true,
                "speed": 500,
                "slidesToShow": 3,
                "slidesToScroll": 3,
                "touchThreshold": 5,
                "autoplay": true,
                "speed": 8000,
                "autoplaySpeed": 2000,
                "cssEase": "linear"
            },
            pizzerie: [],
            giapponesi: [],
            ok: false,
            ko: false,
        }
        
    },
    methods:{
        getPizzerie(){
            axios.get('api/restaurants?typology=2')
                    .then((response)=>{
                        console.log(response.data)
                        this.pizzerie = response.data;
                        
                        if (this.pizzerie.length > 0) {
                            
                            this.ok = true;
                        }
                    }).catch((error)=>{
                        console.log(error);
                    });
        },
        getGiapponesi(){
            axios.get(`api/restaurants?typology=1`)
                    .then((response)=>{
                        this.giapponesi = response.data;
                        if (this.giapponesi.length > 0) {
                            
                            this.ko = true;
                        }
                    }).catch((error)=>{
                        console.log(error);
                    });
        },
        
        
    },
    
    created(){
        this.getPizzerie();
        this.getGiapponesi();
    },
};
</script>

<style lang="scss" scoped>
@import '../../sass/front.scss';
.card-img{
    width: 100%;
    height: 300px;

}
.titolo-carosello{
    font-size: $font-xl;
    font-weight: bolder;
}
</style>
