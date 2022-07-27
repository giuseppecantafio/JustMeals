<template>
    <div>
        <!-- <JumbotronComponent/> -->
        <div class="container">
            <div class="wrapper">
                <span class="titolo-carosello my-5">Le nostre pizzerie</span>
                <i class="fa-solid fa-angle-right" style="text-align:center; padding-left: 5px;"></i>
            </div>
            <VueSlickCarousel :arrows="true" :dots="true" v-bind="settings" v-if="ok">
                <div v-for="pizzeria in pizzerie" :key="pizzeria.id" class="my-3">
                    <div class=" mx-3" style="width: 18rem;">
                    <router-link :to="{ name: 'menu', params: { slug: pizzeria.slug } }" style="color:white" >
                        <img :src="`/storage/${pizzeria.image}`" class="card-img shadow" alt="...">
                        <div class="py-3">
                            <h5 class="text-center restaurant-name-slider">{{pizzeria.name}}</h5>
                        </div>
                    </router-link>
                    </div>
                </div>
                <!-- <template #customPaging="page">
                    <div class="custom-dot">
                        {{ page }}
                    </div>
                </template> -->
            </VueSlickCarousel>
        </div>

        <section>
            <svg xmlns="http://www.w3.org/2000/svg" style="margin-bottom: -138px" viewBox="0 0 1440 320">
                <path fill="#EDEAEB" fill-opacity="1" d="M0,192L48,181.3C96,171,192,149,288,170.7C384,192,480,256,576,245.3C672,235,768,149,864,133.3C960,117,1056,171,1152,181.3C1248,192,1344,160,1392,144L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
            <div class="backg">
                <div class="container consenge">
                    <section class="my-5 text-center">
                        <div class="row ">
                            <div class="col">
                                <img src="https://res.cloudinary.com/glovoapp/image/fetch//q_auto/https://glovoapp.com/images/why-glovo/restaurants.svg" alt="">
                                <div class="title py-3">
                                    I migliori ristoranti della tua città
                                </div>
                                <p class="m-auto">
                                    Con un'ampia varietà di ristoranti puoi ordinare i tuoi piatti preferiti oppure <mark>esplora nuovi ristoranti nei dintorni!</mark> 
                                </p>
                            </div>
                            <div  class="col">
                                <img src="https://res.cloudinary.com/glovoapp/image/fetch//q_auto/https://glovoapp.com/images/why-glovo/delivery.svg" alt="">
                                <div class="title py-3">
                                    Consegna rapida
                                </div>
                                <p class="m-auto">
                                La rapidità è un nostro punto d'orgoglio. Ordina o invia qualsiasi cosa nella tua città e lo ritireremo e te <mark>lo consegneremo nel giro di qualche minuto.</mark> 
                                </p>
                            </div>
                            <div  class="col">
                                <img src="https://res.cloudinary.com/glovoapp/image/fetch//q_auto/https://glovoapp.com/images/why-glovo/groceries.svg" alt="">
                                <div class="title py-3">
                                Consegna della spesa e altro
                                </div>
                                <p class="m-auto">
                                Trova tutto ciò che ti serve! Dai <mark>supermercati ai negozi, dalle farmacie ai fioristi</mark>  — se è nella tua città, te lo portiamo noi.
                                </p>
                            </div>
                        </div>
                    </section>
                    <div class="d-flex justify-content-center my-2">
                        <div class="bottone-storto">
                        <div class="btn p-1 pos">Esplora i locali intorno a te</div>
                            <div class="prospettiva">
                                <router-link class="storto btn" :to="{ name: 'restaurants' }">
                                    <span style="color: transparent; margin-left: 25px;">Esplora i locali intorno a te</span>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <svg xmlns="http://www.w3.org/2000/svg" style="margin-top: -170px" viewBox="0 0 1440 320">
            <path fill="#EDEAEB" fill-opacity="1" d="M0,96L48,101.3C96,107,192,117,288,117.3C384,117,480,107,576,101.3C672,96,768,96,864,133.3C960,171,1056,245,1152,256C1248,267,1344,213,1392,186.7L1440,160L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
        </svg>
        <VueSlickCarousel v-bind="settingslow" v-if="ok" style="width: 100%; margin-top: -250px; z-index: -1;">
            <div v-for="pizzeria in pizzerie" :key="pizzeria.id" >
                <router-link :to="{ name: 'menu', params: { slug: pizzeria.slug } }">
                    <img :src="`/storage/${pizzeria.image}`" class="shadow card-img-top" alt="...">
                </router-link>
            </div>
        </VueSlickCarousel>





        <!-- <div class="container my-5">
            <span class="titolo-carosello my-5">i nostri ristoranti giapponesi</span>
            <i class="fa-solid fa-fish titolo-carosello" style="text-align:center; padding-left: 5px;"></i>
            <VueSlickCarousel :arrows="true" :dots="true" v-bind="settings" v-if="ko" >
                <div v-for="giappo in giapponesi" :key="giappo.id" class="my-3">
                    <div class="mx-3" style="width: 18rem;">
                    <router-link :to="{ name: 'menu', params: { slug: giappo.slug } }" style="text-decoration:none ;" >
                        <img :src="`/storage/${giappo.image}`" class="card-img shadow" alt="...">
                        <div class="py-3">
                            <h5 class="text-center restaurant-name-slider">{{giappo.name}}</h5>
                        </div>
                    </router-link>    
                    </div>
                </div>
            </VueSlickCarousel>
        </div> -->


        <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 1440 320">
            <path fill="#EDEAEB" fill-opacity="1" d="M0,256L40,224C80,192,160,128,240,112C320,96,400,128,480,170.7C560,213,640,267,720,245.3C800,224,880,128,960,112C1040,96,1120,160,1200,186.7C1280,213,1360,203,1400,197.3L1440,192L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path>
        </svg>
        <div class="backg unisciti">
            <div class="container ">
                <section class="text-center ">
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
            <div class="d-flex justify-content-center py-5">
                <div class="bottone-storto">
                <div class="btn p-1 pos">Esplora i locali intorno a te</div>
                    <div class="prospettiva">
                        <a class="storto btn" href="/admin">
                            <span style="color: transparent; margin-left: 25px;">Esplora i locali intorno a te</span>
                        </a>
                    </div>
                </div>
            </div>
            </div>
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
            settingslow:{
                "arrows": false,
                "dots": false,
                "infinite": true,
                "speed": 3000,
                "slidesToShow": 5,
                "slidesToScroll": 1,
                "autoplay": true,
                "speed": 3000,
                "autoplaySpeed": 3000,
                "cssEase": "linear",
                "responsive": [
                    {
                    "breakpoint": 1024,
                    "settings": {
                        "slidesToShow": 3,
                        "slidesToScroll": 3,
                        "infinite": true,
                        "dots": false,
                        "arrows": false,
                    }
                    },
                    {
                    "breakpoint": 768,
                    "settings": {
                        "arrows": false,
                        "slidesToShow": 2,
                        "slidesToScroll": 1,
                        "initialSlide": 1
                    }
                    },
                    {
                    "breakpoint": 480,
                    "settings": {
                        "arrows": false,
                        "slidesToShow": 1,
                        "slidesToScroll": 1
                    }
                    }
                ]
            },
            settings:{
                "dots": true,
                "focusOnSelect": true,
                "infinite": true,
                "speed": 500,
                "slidesToShow": 5,
                "slidesToScroll": 1,
                "touchThreshold": 5,
                "autoplay": true,
                "autoplaySpeed": 2000,
                "pauseOnDotsHover": true,
                "pauseOnFocus": true,
                "pauseOnHover": true,
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
                    "breakpoint": 768,
                    "settings": {
                        "arrows": false,
                        "slidesToShow": 2,
                        "slidesToScroll": 1,
                        "initialSlide": 1
                    }
                    },
                    {
                    "breakpoint": 480,
                    "settings": {
                        "arrows": false,
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
@import '../../sass/mixins.scss';

.card-img{
    width: 100%;
    height: 200px;
    object-fit: cover;
}
.card-img-top{
    width: 100px;
    height: 100px;
    object-fit: cover;
}

.titolo-carosello{
    font-size: $font-xl;
    // font-weight: bolder;
    color: black;
    // text-shadow: 2px 2px 5px rgb(255, 255, 255);
}
i{
    transition: 1s;
}

.wrapper{
    &:hover i{
        position: relative;
        left: 10px;
    }
}

h5{
    color: black;
}
.shadow{
    // box-shadow: 2px 2px 2px black;
    border-radius: 20px;
}

.consenge{
    margin-bottom: 100px;
    margin-top:100px;
    // -color: #eeeaeb;
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
    box-shadow: 2px 2px 5px black;
}
a{
    color: white;
    text-decoration: none !important;
}
.unisciti{
    margin-top: 270px;
    /* margin-bottom: 100px; */
    padding-bottom: 44px;
    padding-top: 100px;
}
.storto{
        border: 1px solid black;
        transform: rotateY(-9deg) rotateX(-11deg) rotateZ(-1deg) translateX(-8px);
        transition: transform 0.5s;
        padding: 12px !important;
    }
    .storto:hover{
        transform: none;
        z-index: 2000;
    }
.prospettiva{
        perspective: 100px;
    }
.pos{
        position: absolute;
        top: 50%;
        left: 50%;
        width: 230px;
        transform: translate(-50%, -50%);
    }
    .bottone-storto{
        position: relative;
    }
.backg{
    background-color: #EDEAEB;
    margin-top: 0 !important;

}
.title{
    font-weight: 700;
}
.custom-dot{
    border: 1px solid black;
    // transform: rotate(85deg) scale(0.7) skew(19deg) translate(-1px,0px);
    transform: skew(26deg);
}
</style>
