<template>

    <div class="my-container">

        <h1 v-if="restaurant">Menù {{ restaurant.name }}</h1>
        
        <div class="my-row">

            <div class="my-card" v-for="(item, index) in menu" :key="index">

                <div class="my-wrapper">

                    <div class="card-top" style="height: 300px;">
                        <img :src="`/storage/${item.image}`" alt="ciao" style="height: 100%; width: 100%; object-fit: cover; object-position: center">
                    </div>



                </div>
                <div class="card-bottom">
                    <svg class="card__arc" xmlns="http://www.w3.org/2000/svg"><path /></svg>    
                    <p>{{item.name}}</p>
                </div>




                <!-- <div>{{ item.name }}</div>

                <div>{{ item.price }}</div>

                <div>
                    <span>Disponibilità </span>
                    <i v-if="item.available === 1" class="fa-solid fa-circle-check" style="color: green"></i>
                    <i v-else class="fa-solid fa-circle-xmark" style="color: red"></i>
                </div>

                <button v-if="item.available === 1" @click="addToCart(item)" class="btn btn-primary" >
                    Aggiungi al carrello
                </button>
                <button v-else class="btn btn-secondary" >
                    Aggiungi al carrello
                </button> -->


                <div class="d-flex justify-content-between margine">
                    <div>Prezzo: {{ item.price }} &euro;</div>
                    <button v-if="item.available === 1" @click="addToCart(item)" class="btn text-light rounded-circle" style="background-color: #43abae;">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <button v-else class="btn text-light rounded-circle" style="background-color: #ff7210;">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "MenuComponent",
    data() {
        return {
            menu: [],
            cart: [],
            restaurant: {},
        };
    },
    methods: {
        addToCart(item) {
            // console.log('1--- ',item)
            let check = false;
            if (this.cart.length > 0) {
                // console.log(this.cart);
                // console.log(item);

                this.cart.forEach((element) => {
                    if (element.restaurant_id != item.restaurant_id) {
                        check = true;
                        // console.log("2---######################################################################################");
                        // console.log("3---element: ",
                        //     element.restaurant_id,
                        //     "item: ",
                        //     item.restaurant_id
                        // );
                    }
                });

                if (check) {
                    let destroy = confirm("Svuotare il carrello con l'ordine di un altro ristorante per proseguire?")
                    if(destroy){
                        this.emptyCart()
                        this.cart.push(item);
                        window.localStorage.setItem(`item${this.cart.length}`,JSON.stringify(item));
                    }
                    // console.log('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA')
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
                    // this.cart.push(item);
                    // window.localStorage.setItem(
                    //     `item${this.cart.length}`,
                    //     JSON.stringify(item)
                    // );
                    // console.log("4---?????????????????????????????????????????????????");
                    // console.log('5---',this.cart);
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
            const slug = this.$route.params.slug;
            axios
                .get(`/api/restaurants/${slug}`)
                .then((response) => {
                    this.menu = response.data.items;
                    this.restaurant = response.data;
                    console.log("7---RESTAURANT : ", response.data);
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
    },
    created() {
        this.getMenu();
        this.getCartItems();
    },
    updated(){
        this.cardsJs()
    }
};
</script>

<style lang="scss" scoped>



/* CARTE SELEZIONATE */
.selected-left{    
    z-index: 100;
    transform:skew(1deg) scale(1.05) rotate(1deg) ;
}
.selected-right {
    z-index: 100;
    transform: skew(-1deg) scale(1.05) rotate(-1deg);
}
.selected-center{
    z-index: 100;
    transform: scale(1.05);
}
.selected-lonely{
    z-index: 100;
    transform: scale(1.05);
}



/* CARTE VICINE SE SELEZIONATO A SINISTRA */
.left-left-sibling {
    transform: skew(-1deg) scale(1.05) rotate(-1deg);
    z-index: 50;
    width: calc(20% - 50px);
}
.left-right-sibling{
    transform:skew(-1deg) scale(1.05) rotate(-1deg) ;
    z-index: 50;
    width: calc(20% - 50px);
}


/* CARTE VICINE SE SELEZIONATO A DESTRA */
.right-left-sibling {
    transform: skew(1deg) scale(1.05) rotate(1deg);
    z-index: 50;
    width: calc(20% - 50px);
}
.right-right-sibling {
    transform: skew(1deg) scale(1.05) rotate(1deg);
    z-index: 50;
    width: calc(20% - 50px);
}


@media screen and (max-width: 1200px){
    .my-card{
        width: calc((100% / 3) - (15px * 2 / 3));
    }
    .left-left-sibling, 
    .left-right-sibling, 
    .right-right-sibling, 
    .right-left-sibling {
        width: calc((100% / 3) - 50px);
    }
}

@media screen and (max-width: 840px) {
    .my-card {
        width: calc((100% / 2) - (15px * 1 / 2));
    }

    .left-left-sibling,
    .left-right-sibling,
    .right-right-sibling,
    .right-left-sibling {
        width: calc((100% / 2) - 50px);
    }
}

@media screen and (max-width: 700px) {
    .my-row{
        gap: 30px;
    }
    .my-card {
        width: calc(80% - 15px);
    }

    .left-left-sibling,
    .left-right-sibling,
    .right-right-sibling,
    .right-left-sibling {
        width: calc(80% - 50px);
    }
}





.my-container{
    width: 90%;
    margin: 0 auto;

    .my-row {
        display: flex;
        flex-wrap: wrap;
        position: relative;
        justify-content: center;
        row-gap: 5px;
        column-gap: 5px;

        .my-card {
            display: inline-block;
            min-height: 200px;
            position: relative;
            height: 50%;
            width: calc(20% - (15px * 4 / 5));
            transition: all 0.35s;
            background-color: rgba($color: #EDEAEB, $alpha: 1);
            background-color: #323232;
            border-radius: 30px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 300px;
            overflow: hidden;

            &:hover{
                transition: all 0.35s;
                box-shadow: rgba(0, 0, 0, 0.56) 0px 22px 40px 4px;
            }
            .my-wrapper{
                height: calc(100% - 13px);
                width: calc(100% - 13px);
                overflow: hidden;
                border-radius: 25px;
                position: absolute;
                
            }
                .card-bottom{
                    position: absolute; 
                    bottom: -80px; 
                    height: 160px; 
                    width: 100%; 
                    background-color: #EDEAEB; 
                    border-radius: 30px 0 0 0;
                    transition: 0.3s;
                    text-align: center;
                    color: #323232;
                    
                    &:hover{
                        bottom: 0;
                    }
                    
                    .card__arc {
                        width: 80px;
                        height: 80px;
                        position: absolute;
                        top: -79px;
                        right: 0;      
                        z-index: 1;
                    }
                    .card__arc path {
                        fill: #EDEAEB;
                        d: path("M 40 80 c 22 0 40 -22 40 -40 v 40 Z");
                    }    
                }

        }
    }
}

</style>
