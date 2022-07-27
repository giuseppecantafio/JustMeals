<template>

    <div class="my-container">

        <loading-component v-if="loading" class="loader" />

        <h1 v-if="restaurant">Menù {{ restaurant.name }}</h1>
        

        <div class="my-row">

            <div class="my-card" v-for="(item, index) in menu" :key="index">

                <!-- CARD TOP / IMMAGINE -->
                <div class="my-wrapper">
                    <div class="card-top" style="height: 300px;">

                        <img class="available" v-if="item.image" :src="`/storage/${item.image}`" alt="image not available sorry" >

                        <figure v-else>
                            <img class="wrap-icon" src="/images/wrap-white.png" alt="wrap icon">
                            <figcaption>Immagine non disponibile</figcaption>
                        </figure>

                    </div>
                </div>

                <!-- CARD BOTTOM -->
                <div class="card-bottom">

                    <!-- svg -->
                    <svg class="card__arc" xmlns="http://www.w3.org/2000/svg">
                        <path />
                        <defs>
                            <pattern id="img1" patternUnits="userSpaceOnUse" width="100" height="100">
                                <image href="/images/wrap-paper-2.jpg" x="0" y="0" width="100" height="100" />
                            </pattern>
                        </defs>
                    </svg>    

                    <!-- testo -->
                    <div class="text">
                        <div class="out-text">
                            <h5 class="name">{{item.name}}</h5>
                            <i class="fa-solid fa-eye"></i>
                        </div>

                        <div class="inner-text">

                            <div class="description">{{item.description}}</div>

                            <div class="card-footer">
                                <div class="price">{{item.price}} &euro;</div>

                                <div class="cart">

                                <div class="d-flex" v-if="item.available === 1" @click="addToCart(item)">
                                    <div class="bottone-storto">
                                        <div class="btn p-1 pos">Aggiungi</div>
                                        <div class="prospettiva">
                                            <button class="storto btn">
                                                <span style="color: transparent;">Aggiungi</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex" v-else>

                                    <div class="bottone-storto">
                                        <div class="d-flex btn p-1 pos">
                                            <i style="margin-right: 5px; font-size: 13px; color: red; align-self: center; vertical-align: middle" class="fa-solid fa-circle-xmark"></i>
                                            <span style="margin-right: 3px">Finito!</span>
                                        </div>
                                        <div class="prospettiva" style="opacity: 0">
                                            <button class="storto btn finto">
                                                <span style="color: transparent;">Finito!</span>
                                            </button>
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
import LoadingComponent from '../components/LoadingComponent.vue'

export default {
    name: "MenuComponent",
    data() {
        return {
            menu: [],
            cart: [],
            restaurant: {},
            loading: false
        };
    },
    components: {
        LoadingComponent
    },
    created() {
        this.getMenu();
        this.getCartItems();
    },
    updated(){
        this.cardsJs()
    },
    methods: {
        addToCart(item) {
            let check = false;
            if (this.cart.length > 0) {

                this.cart.forEach((element) => {
                    if (element.restaurant_id != item.restaurant_id) {
                        check = true;
                    }
                });

                if (check) {
                    let destroy = confirm("Svuotare il carrello con l'ordine di un altro ristorante per proseguire?")
                    if(destroy){
                        this.emptyCart()
                        this.cart.push(item);
                        window.localStorage.setItem(`item${this.cart.length}`,JSON.stringify(item));
                    }
                } else {
                    // QUI CICLO QUANTITA
                    // CARRELLO NON VUOTO

                    let nuovo = true
                    for (const [key, value] of Object.entries(window.localStorage)) {
                        let parsato = JSON.parse(value)
                      
                        if(parsato.name === item.name){
                                let q = parsato.quantity
                                console.log(key);
                                let vecchiaQuantity = parseInt(key.replace('item', ''))
                                console.log(vecchiaQuantity);
                                window.localStorage.removeItem(key);

                                item.quantity = q + 1
                                window.localStorage.setItem(`item${vecchiaQuantity}`,JSON.stringify(item));

                                nuovo = false

                                return console.log(localStorage)

                        }    
                        
                    }
                    if(nuovo){
                        item.quantity = 1
                        this.cart.push(item);
                        window.localStorage.setItem(`item${this.cart.length}`,JSON.stringify(item));
                        return console.log(localStorage)
                    }
                }
            } else {
                item.quantity = 1
                this.cart.push(item);
                window.localStorage.setItem(
                    `item${this.cart.length}`,
                    JSON.stringify(item)
                );
                console.log('6---',this.cart);
            }
        },
        getCartItems() {
            for (const [key, value] of Object.entries(window.localStorage)) {
                let newValue = JSON.parse(value);
                let item = {};
                item.name = newValue.name;
                item.price = newValue.price;
                item.restaurant_id = newValue.restaurant_id;
                item.id = key;
                item.quantity = newValue.quantity;
                this.cart.push(item);
            }
        },
        getMenu() {
            this.loading = true
            const slug = this.$route.params.slug;
            axios
                .get(`/api/restaurants/${slug}`)
                .then((response) => {
                    this.menu = response.data.items;
                    this.restaurant = response.data;
                    console.log("7---RESTAURANT : ", response.data);
                    this.loading = false
                    this.cardsJs()
                })
                .catch((error) => {
                    console.log('8---',error);
                });
        },
        emptyCart() {
            window.localStorage.clear();
            this.cart = [];
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
@import '../../sass/partials/cardsJs.scss';
@import '../../sass/partials/cardsJs_row.scss';

.card-bottom{
    background-image: url('/images/wrap-paper-2.jpg');
}
.card__arc path {
    fill: url(#img1) !important;
}

.storto:hover{
    border: 3px solid $my-light-blue !important;
}

</style>
