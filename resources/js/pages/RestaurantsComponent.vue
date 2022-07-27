<template>
<div class="big-wrapper">      

    <loading-component v-if="loading" class="loader" />

    <!-- checkboxes -->

    <div class="checks-wrapper">
        <!-- Typologies -->
        <div class="m-3">
            <i class="fa-solid fa-utensils"></i>
            Per categoria:
        </div>
        <div class="form-check" v-for="typology in typologies" :key="typology.id" >
            <div class="d-flex align-center justify-content-between gap-3 py-2 border-rounded">
                <label class="form-check-label px-1" >
                    {{typology.name}}
                </label>
                <label class="checkbox path">
                    <input class="form-check-input" type="checkbox" :value="typology.id" @change="filterRestaurants()" id="flexCheckDefault" v-model="selectTypo">
                    <svg viewBox="0 0 21 21">
                        <path d="M5,10.75 L8.5,14.25 L19.4,2.3 C18.8333333,1.43333333 18.0333333,1 17,1 L4,1 C2.35,1 1,2.35 1,4 L1,17 C1,18.65 2.35,20 4,20 L17,20 C18.65,20 20,18.65 20,17 L20,7.99769186"></path>
                    </svg>
                </label>

            </div>
        </div>
    </div>
    <!-- fine Checkboxes -->

    <!-- cards -->

    <div class="container-box">

        <div class="my-container">        

            <div class="my-row">

                <div class="my-card" v-for="restaurant in restaurants" :key="restaurant.id">

                    <!-- CARD TOP / IMMAGINE -->
                    <div class="my-wrapper">
                        <div class="card-top" style="height: 300px;">

                            <img class="available" v-if="restaurant.image" :src="`/storage/${restaurant.image}`" alt="image not available sorry" >

                            <figure v-else>
                                <img class="wrap-icon" src="/images/wrap-white.png" alt="wrap icon">
                                <figcaption>Immagine non disponibile</figcaption>
                            </figure>

                        </div>
                    </div>

                    <!-- CARD BOTTOM -->
                    <div class="card-bottom">

                        <!-- svg -->
                        <svg class="card__arc" xmlns="http://www.w3.org/2000/svg"><path /></svg>    

                        <!-- testo -->
                        <div class="text">
                            <div class="out-text">
                                <h5 class="name">{{restaurant.name}}</h5>
                                <i class="fa-solid fa-eye"></i>
                            </div>

                            <div class="inner-text">

                                <div class="description">

                                    <div v-if="restaurant.user" class="user_rest">di {{restaurant.user.surname}} {{restaurant.user.name}}</div>

                                    <div class="types" v-if="(restaurant.typologies)">
                                        <div v-for="typology in restaurant.typologies" :key="typology.id" class="type">{{typology.name}}</div>
                                    </div>
                                    
                                </div>

                                <div class="card-footer">

                                    <div class="price">{{restaurant.address}}</div>

                                    <div class="cart">

                                        <div class="d-flex">
                                            <div class="bottone-storto">
                                                <div class="btn p-1 pos">MENU</div>
                                                <div class="prospettiva">
                                                    <router-link class="storto btn"  :to="{ name: 'menu', params: { slug: restaurant.slug } }">
                                                        <span style="color: transparent;">MENU</span>
                                                    </router-link>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                            
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>





</div>
</template>

<script>
import LoadingComponent from "../components/LoadingComponent.vue"
export default {
    name: "RestaurantsComponent",
    components: {
        LoadingComponent,
    },
    data() {
        return {
            restaurants: [],
            typologies: [],
            selectTypo: [],
            apiPath: 'api/restaurants',
            loading: false,
        }
    },
    created(){
        this.getApiTypologies();
        this.filterRestaurants();
    },
    updated(){
        this.cardsJs();
    },
    methods: {
        getApiTypologies() {
            this.loading = true;
            setTimeout(()=>{
            axios.get("api/typologies")
                .then((response) => {
                    this.typologies = response.data;
                    // this.filterRestaurants();
                    this.loading = false;
                })
                .catch((error) => {
                    console.log('1---',error);
                });
                },400)
        },
        filterRestaurants(){

            if (this.selectTypo.length > 0){

                let finalQuery = '';
                this.selectTypo.forEach((el) =>{
                    finalQuery += (el + ',')
                });
                    this.loading = true;
                    setTimeout(()=>{
                axios.get(`${this.apiPath}?typology=${finalQuery}`)
                    .then((response)=>{
                        this.loading = false;
                        this.restaurants = response.data;
                        // console.log('3---',this.selectTypo);
                        this.cardsJs();
                    }).catch((error)=>{
                        console.log(error);
                    });
                    },400)
            } else {
                // console.log('SONO QUI')
                this.loading = true;
                axios.get(this.apiPath)
                    .then((response)=>{
                        console.log('5,1---',response.data)
                        this.loading = false;
                        this.restaurants = response.data;
                        this.cardsJs();
                        // console.log('5---',this.restaurants)
                    }).catch((error)=>{
                        console.log(error);
                    });
            }
        },
        cardsJs(){
            const classArray = ['start', 'middle-left', 'center', 'middle-right', 'end']
            const triArray = ['start', 'center', 'end']
            let duArray = ['start', 'end']

            let cycle = 0
            let ducycle = 0
            let tricycle = 0


            let count = 0
            let secondCount = 0
            const cards = document.querySelectorAll('.my-card')

            console.log(cards)

            let noBreakpoint = false
            let breakPointOne = 1200
            let oneBreaked = false
            let breakPointTwo = 840
            let twoBreaked = false
            let breakPointThree = 700
            let threeBreaked = false


            cardsResize()

            window.addEventListener('resize', cardsResize)


            // FUNZIONE ON HOVER
            function over() {
                count = 0
                
                if (this.classList.contains('middle-left')) {
                    count = parseInt(this.classList[1])
                    secondCount = count - 2

                    this.classList.add('selected-left')
                    cards[count].classList.add('left-right-sibling')
                    cards[secondCount].classList.add('left-left-sibling')

                    this.removeEventListener('mouseover', over)
                    this.addEventListener('mouseout', out)
                
                } else if (this.classList.contains('middle-right')) {
                    count = parseInt(this.classList[1])
                    secondCount = count - 2

                    this.classList.add('selected-right')
                    cards[count].classList.add('right-right-sibling')
                    cards[secondCount].classList.add('right-left-sibling')

                    this.removeEventListener('mouseover', over)
                    this.addEventListener('mouseout', out)
                
                } else if (this.classList.contains('end')) {
                    count = parseInt((this.classList[1]) - 2)

                    this.classList.add('selected-right')
                    if (cards[count]) {
                        cards[count].classList.add('right-left-sibling')
                    }

                    this.removeEventListener('mouseover', over)
                    this.addEventListener('mouseout', out)

                } else if (this.classList.contains('start')) {
                    count = parseInt(this.classList[1])
                    
                    this.classList.add('selected-left')
                    if (cards[count]) {
                        
                        cards[count].classList.add('left-right-sibling')
                    }
                    
                    
                    this.removeEventListener('mouseover', over)
                    this.addEventListener('mouseout', out)

                } else if (this.classList.contains('center')) {
                    count = parseInt(this.classList[1])
                    secondCount = count - 2

                    this.classList.add('selected-center')
                    if (cards[count]) {
                        
                        cards[count].classList.add('right-right-sibling')
                    }
                    if (cards[secondCount]) {
                        
                        cards[secondCount].classList.add('left-left-sibling')
                    }

                    this.removeEventListener('mouseover', over)
                    this.addEventListener('mouseout', out)

                } else if (this.classList.contains('only-end')) {
                    this.classList.add('selected-lonely')

                    this.removeEventListener('mouseover', over)
                    this.addEventListener('mouseout', out)
                }
            
            }


            // FUNZIONE FOCUS OUT
            function out() {
                if (this.classList.contains('selected-left')) {
                    this.classList.remove('selected-left')
                } else if(this.classList.contains('selected-right')) {
                    this.classList.remove('selected-right')
                } else if (this.classList.contains('selected-lonely')){
                    this.classList.remove('selected-lonely')
                } else {
                    this.classList.remove('selected-center')
                }
                
                let possibleClasses = ['left-right-sibling', 'left-left-sibling', 'right-right-sibling', 'right-left-sibling']

                if (cards[count]) {
                    possibleClasses.forEach((el) => {
                        if (cards[count].classList.contains(el)) {
                            cards[count].classList.remove(el)
                        }
                    })
                }

                if (cards[secondCount]) {
                    possibleClasses.forEach((el) => {
                        if (cards[secondCount].classList.contains(el)) {
                            cards[secondCount].classList.remove(el)
                        }
                    })
                }

                this.removeEventListener('mouseout', out)
                this.addEventListener('mouseover', over)

            }


            function generateClass(card, number) {
                card.classList.add(`${number}`)
            }

            function cardsResize() {
                console.log('sizing')
                if (window.innerWidth < breakPointOne && window.innerWidth > breakPointTwo && oneBreaked === false) {

                    // tre card
                    noBreakpoint = false
                    oneBreaked = true
                    twoBreaked = false
                    threeBreaked = false
                    tricycle = 0

                    console.log('TRE CARD')

                    
                    console.log(noBreakpoint, oneBreaked, twoBreaked, threeBreaked)
                    

                    cards.forEach((card) => {
                        classArray.forEach((classe) => {
                            if (card.classList.contains(classe)) {
                                card.classList.remove(classe);
                            }
                        })
                        // ciclo per metterle nuove
                        let classToGive = triArray[tricycle]
                        card.classList.add(classToGive)

                        tricycle++;
                        if (tricycle === 3) {
                            tricycle = 0
                        }

                        card.addEventListener('mouseover', over)
                        card.addEventListener('mouseout', out)

                    })

                    switch (cards.length % 3) {
                        case 0:
                            break;
                        case 1:
                            cards[cards.length - 1].classList.remove('start')
                            cards[cards.length - 1].classList.add('only-end')
                            break;
                        case 2:
                            cards[cards.length - 1].classList.remove('center')
                            cards[cards.length - 1].classList.add('end')
                    }

                    


                } else if (window.innerWidth < breakPointTwo && window.innerWidth > breakPointThree && twoBreaked === false) {

                    console.log('DUE CARD')
                    //  due card
                    noBreakpoint = false
                    oneBreaked = false
                    twoBreaked = true
                    threeBreaked = false
                    ducycle = 0

                    cards.forEach((card) => {
                        classArray.forEach((classe) => {
                            if (card.classList.contains(classe)) {
                                card.classList.remove(classe);
                            }
                        })
                        // ciclo per metterle nuove
                        let classToGive = duArray[ducycle]
                        card.classList.add(classToGive)

                        ducycle++;
                        if (ducycle === 2) {
                            ducycle = 0
                        }

                        card.addEventListener('mouseover', over)
                        card.addEventListener('mouseout', out)

                    })

                    switch (cards.length % 2) {
                        case 0:
                            break;
                        case 1:
                            cards[cards.length - 1].classList.remove('start')
                            cards[cards.length - 1].classList.add('only-end')
                    }
                    


                } else if (window.innerWidth < breakPointThree && threeBreaked === false) {

                    console.log('UNA CARD')
                    // una card

                    noBreakpoint = false
                    oneBreaked = false
                    twoBreaked = false
                    threeBreaked = true

                    cards.forEach((card) => {
                        classArray.forEach((classe) => {
                            if (card.classList.contains(classe)) {
                                card.classList.remove(classe);
                            }
                        })
                        card.classList.add('only-end')

                        card.addEventListener('mouseover', over)
                        card.addEventListener('mouseout', out)
                    })
                    
                } else if (window.innerWidth > breakPointOne && noBreakpoint === false) {

                    console.log('CINQUE CARD')
                    // cinque cards

                    cycle = 0


                    noBreakpoint = true
                    oneBreaked = false;
                    twoBreaked = false;
                    threeBreaked = false;

                    cards.forEach((card, index) => {
                        classArray.forEach((classe) => {
                            if (card.classList.contains(classe)) {
                                card.classList.remove(classe);
                            }
                        })

                        generateClass(card, (index + 1))
                    
                        let classToGive = classArray[cycle]
                        card.classList.add(classToGive)
                        cycle++;
                        if (cycle === 5) {
                            cycle = 0
                        }
                    
                        card.addEventListener('mouseover', over)
                        card.addEventListener('mouseout', out)
                    })

                    switch (cards.length % 5) {
                        case 0:
                            break;
                        case 1:
                            cards[cards.length - 1].classList.remove('start')
                            cards[cards.length - 1].classList.add('only-end')
                            break;
                        case 2:
                            cards[cards.length - 1].classList.remove('middle-left')
                            cards[cards.length - 1].classList.add('end')
                            break;
                        case 3:
                            cards[cards.length - 2].classList.remove('middle-left')
                            cards[cards.length - 2].classList.add('center')
                            cards[cards.length - 1].classList.remove('center')
                            cards[cards.length - 1].classList.add('end')
                            break;
                        case 4:
                            cards[cards.length - 2].classList.remove('center')
                            cards[cards.length - 2].classList.add('middle-right')
                            cards[cards.length - 1].classList.remove('middle-right')
                            cards[cards.length - 1].classList.add('end')
                            break;
                    }
                }
            }
        }
    }
    
};
</script>

<style lang="scss" scoped>
@import '../../sass/front.scss';
@import '../../sass/partials/cardsJs_row.scss';

.big-wrapper{

    .loader{
        position: absolute;
        left: 50%;
        top: 0;
        transform: translateX(-50%);
    }

    display: flex;
    gap: calc(20px + 1rem);
    padding: 0 calc(20px + 1rem);
    .checks-wrapper{
        padding-top: 50px;
    }
    .container-box{
        flex-grow: 1;
        .my-container{
            margin: 0 auto;
            width: 100%;
        }
    }

}

.price{
    font-size: 11px;
}
.description{
    padding-top: 0 !important;
    .user_rest{
        font-style: oblique;
    }
    .types{
        margin-top: 30px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        justify-content: center;
        .type{
            display: inline-block;
            border-radius: 9px;
            padding: 5px 15px;
            background: $my-light-blue;
            color: $my-white;
        }
    }
}

@media screen and (max-width: 1000px) {

    .big-wrapper{
        flex-wrap: wrap;
        .container-box{
            width: 100%;
            .my-container{
                margin: 0 auto;
                width: 100%;
            }
        }

    }

}

@import '../../sass/partials/cardsJs.scss';



// SEZIONE CHECKBOXES

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

.scale-in-center{animation:scale-in-center .1s cubic-bezier(.25,.46,.45,.94) both}
@keyframes scale-in-center{0%{transform:scale(0);opacity:1}100%{transform:scale(1);opacity:1}}







</style>
