<template>
    <div>
        <div class="container">
            <VueSlickCarousel :arrows="true" :dots="true" v-bind="settings" v-if="ok">
                <div v-for="pizzeria in pizzerie" :key="pizzeria.id">
                    <div>
                        
                        {{pizzeria.name}}
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
        }
        
    },
    methods:{
        getPizzerie(){
            axios.get('api/restaurants?typology=1')
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
            axios.get(`api/restaurants?typology=Giapponese`)
                    .then((response)=>{
                        this.giapponesi = response.data;
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

</style>
