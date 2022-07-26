function cardsApp(){const classArray = ['start', 'middle-left', 'center', 'middle-right', 'end']
const triArray = ['start', 'center', 'end']
let duArray = ['start', 'end']

let cycle = 0
let ducycle = 0
let tricycle = 0


let count = 0
let secondCount = 0
const cards = document.querySelectorAll('.card')

console.log(cards)

let noBreakpoint = false
let breakPointOne = 1000
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

// RANDOM COLOR
function randomColor(){
    
    const myArray = ['a', 'b', 'c', 'd', 'e', 'f']
    for (i=0; i < 10; i++){
      myArray.push(i)
    }

    let color = '#'
    for(i=0; i<6; i++){
    color += myArray[Math.floor(Math.random() * (myArray.length))]
    }

    return color
}


function generateClass(card, number) {
    card.classList.add(`${number}`)
}

function checkLength(array) {
    return array.length % 5
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
            if (!card.style.backgroundColor) {
                card.style.backgroundColor = randomColor()
            }

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
            if (!card.style.backgroundColor) {
                card.style.backgroundColor = randomColor()
            }

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
            if (!card.style.backgroundColor) {
                card.style.backgroundColor = randomColor()
            }

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
            if (!card.style.backgroundColor) {
                card.style.backgroundColor = randomColor()
            }
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
}}