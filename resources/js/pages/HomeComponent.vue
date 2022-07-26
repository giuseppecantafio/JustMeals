<template>
    <div>
        <JumbotronComponent/>
        <div class="container">
            <span class="titolo-carosello my-5">le nostre pizzerie</span>
            <i class="fa-solid fa-pizza-slice"></i>
            <VueSlickCarousel :arrows="true" :dots="true" v-bind="settings" v-if="ok">
                <div v-for="pizzeria in pizzerie" :key="pizzeria.id" class="my-3">
                    <div class=" mx-3" style="width: 18rem;">
                    <router-link :to="{ name: 'menu', params: { slug: pizzeria.slug } }" style="color:white" >
                        <img :src="`/storage/${pizzeria.image}`" class="card-img shadow" alt="...">
                        <div>
                            <h5 class="text-center">{{pizzeria.name}}</h5>
                        </div>
                    </router-link>    
                    </div>
                </div>
            </VueSlickCarousel>
        </div>
        <div class="container consenge">

        <section class="my-5 text-center">
            <div class="row ">
                <div class="col">
                    <img src="https://res.cloudinary.com/glovoapp/image/fetch//q_auto/https://glovoapp.com/images/why-glovo/restaurants.svg" alt="">
                    <div class="title py-2">
                        I migliori ristoranti della tua città
                    </div>
                    <p class="m-auto">
                        Con un'ampia varietà di ristoranti puoi ordinare i tuoi piatti preferiti oppure <mark>esplora nuovi ristoranti nei dintorni!</mark> 
                    </p>
                </div>
                <div  class="col">
                    <img src="https://res.cloudinary.com/glovoapp/image/fetch//q_auto/https://glovoapp.com/images/why-glovo/delivery.svg" alt="">
                    <div class="title py-2">
                        Consegna rapida
                    </div>
                    <p class="m-auto">
                    La rapidità è un nostro punto d'orgoglio. Ordina o invia qualsiasi cosa nella tua città e lo ritireremo e te <mark>lo consegneremo nel giro di qualche minuto.</mark> 
                    </p>
                </div>
                <div  class="col">
                    <img src="https://res.cloudinary.com/glovoapp/image/fetch//q_auto/https://glovoapp.com/images/why-glovo/groceries.svg" alt="">
                    <div class="title py-2">
                    Consegna della spesa e altro
                    </div>
                    <p class="m-auto">
                    Trova tutto ciò che ti serve! Dai <mark>supermercati ai negozi, dalle farmacie ai fioristi</mark>  — se è nella tua città, te lo portiamo noi.
                    </p>
                </div>
            </div>
            
        </section>
            <button class="btn bottone d-flex m-auto border-rounded">
                <a href="/restaurants">Esplora i locali intorno a te</a> 
            </button>
        </div>
        <div class="container my-5">
            <span class="titolo-carosello my-5">i nostri ristoranti giapponesi</span>
            <i class="fa-solid fa-fish"></i>
            <VueSlickCarousel :arrows="true" :dots="true" v-bind="settings" v-if="ko" >
                <div v-for="giappo in giapponesi" :key="giappo.id" class="my-3">
                    <div class="mx-3" style="width: 18rem;">
                    <router-link :to="{ name: 'menu', params: { slug: giappo.slug } }" style="text-decoration:none ;" >
                        <img :src="`/storage/${giappo.image}`" class="card-img shadow" alt="...">
                        <div>
                            <h5 class="text-center">{{giappo.name}}</h5>
                        </div>
                    </router-link>    
                    </div>
                </div>
            </VueSlickCarousel>
        </div>
        <div class="container unisciti">
            <section class="my-5 text-center ">
                <div class="row ">
                    <div class="col">
                        <img src="https://res.cloudinary.com/glovoapp/image/fetch//w_254,h_220,c_fit,f_auto,q_auto:best/dpr_auto/https://glovoapp.com/images/corporate/rider-image.png" alt="">
                        <div class="title py-2">
                            Diventa un rider
                        </div>
                        <p class="m-auto">
                            Diventa il capo di te stesso! Goditi flessibilità, libertà e guadagni competitivi effettuando consegne con Glovo.
                        </p>
                    </div>
                    <div class="col">
                        <img src="https://res.cloudinary.com/glovoapp/image/fetch//w_254,h_220,c_fit,f_auto,q_auto:best/dpr_auto/https://glovoapp.com/images/corporate/partners-image.png" alt="">
                        <div class="title py-2">
                            Diventa partner
                        </div>
                        <p class="m-auto">
                            Cresci con Glovo! La nostra tecnologia e la nostra base di utenti possono aiutarti a incrementare le vendite e aprire nuove opportunità!
                        </p>
                    </div>
                    <div class="col">
                        <img src="https://res.cloudinary.com/glovoapp/image/fetch//w_254,h_220,c_fit,f_auto,q_auto:best/dpr_auto/https://glovoapp.com/images/corporate/carrers-image.png" alt="">
                        <div class="title py-2">
                            Lavora con noi
                        </div>
                        <p class="m-auto">
                            Pronto per una nuova ed entusiasmante sfida? Se sei ambizioso, umile e ami lavorare con gli altri, mettiti in contatto con noi!
                        </p>
                    </div>
                </div>
            </section>  
        </div>
        <div class=" d-flex justify-content-center">
            <button class="btn bottone d-flex border-rounded my-5 ">
                <a href="/admin">Unisciti a noi</a> 
            </button>
        </div>
    </div>
</template>

<script>
import JumbotronComponent from '../components/JumbotronComponent.vue'
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
  // optional style for arrows & dots
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

export default {
    name: "HomeComponent",
    components: { VueSlickCarousel, JumbotronComponent },
    data(){
        return{
            settings:{
                "dots": true,
                "focusOnSelect": true,
                "infinite": true,
                "speed": 500,
                "slidesToShow": 3,
                "slidesToScroll": 1,
                "touchThreshold": 5,
                "responsive": [
                    {
                    "breakpoint": 1024,
                    "settings": {
                        "slidesToShow": 3,
                        "slidesToScroll": 3,
                        "infinite": true,
                        "dots": true
                    }
                    },
                    {
                    "breakpoint": 600,
                    "settings": {
                        "slidesToShow": 2,
                        "slidesToScroll": 2,
                        "initialSlide": 2
                    }
                    },
                    {
                    "breakpoint": 480,
                    "settings": {
                        "slidesToShow": 1,
                        "slidesToScroll": 1
                    }
                    }
                ]
                
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
    color: $dark-light-blue;
}

h5{
    text-decoration: none;
    color: $dark-light-blue;
}
.shadow{
    box-shadow: 2px 2px 2px;
    border-radius: 20px;
}

.consenge{
    margin-bottom: 100px;
    margin-top:100px;
}

img{
    width: 190px;
}
mark{
    border-radius: 50px;
    padding: 0px !important;
    padding-top: 2px !important;
    display: inline-block;
    line-height: 12px;
    background-color: #eeeaeb;
}
.bottone{
    background-color: #0d9ca4;
    color: white;
}
a{
    color: white;
    text-decoration: none;
}
.unisciti{
    padding-top: 50px;
}
</style>
