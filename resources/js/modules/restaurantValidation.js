window.restaurantValidation = {
    form: null,
    address: null,
    vat: null,
    typologies: null,
    name: null,

    numberChecked: false,
    viaChecked: false,
    vatChecked: false,
    typologiesChecked: false,
    nameChecked: false,

    vatError: null,
    viaAddressError: null,
    numberAddressError: null,
    typologyError: null,
    nameError: null,

    controlAndConfirm(e) {
        e.preventDefault();

        // prendo gli input
        this.address = document.getElementById('address')
        this.form = document.querySelector('.form-js')
        this.vat = document.getElementById('vat');
        this.typologies = document.querySelectorAll('input[type=checkbox]')
        this.nameForm = document.getElementById('name-form');


        // prendo i div degli errori
        this.vatError = document.querySelector('.vat-error')
        this.viaAddressError = document.querySelector('.viaAddress-error')
        this.numberAddressError = document.querySelector('.numberAddress-error')
        this.typologyError = document.querySelector('.typology-error')
        this.nameError = document.querySelector('.name-error')

        // controllo address
        this.viaChecked = window.restaurantValidation.checkStreet(this.address.value)
        this.numberChecked = window.restaurantValidation.checkNumber(this.address.value)
        // controllo vat
        this.vatChecked = window.restaurantValidation.checkVat(this.vat.value)
        // controllo typologies / checkboxes
        this.typologiesChecked = window.restaurantValidation.boxControl(this.typologies)
        // controllo name
        this.nameChecked = window.restaurantValidation.checkName(this.nameForm.value)


        // rimetto a ogni submit il d-none
        // this.viaAddressError.classList.add('d-none')
        this.vatError.classList.add('d-none')
        this.numberAddressError.classList.add('d-none')
        this.typologyError.classList.add('d-none')
        this.nameError.classList.add('d-none')

        
        // submit
        if (this.nameChecked === false) {
            this.nameError.classList.remove('d-none')
        } else if(this.viaChecked === false) {
            this.viaAddressError.classList.remove('d-none')
        } else if(this.numberChecked === false) {
            this.numberAddressError.classList.remove('d-none')
        } else if (this.vatChecked === false) {
            this.vatError.classList.remove('d-none')
        } else if (this.typologiesChecked === false) {
            this.typologyError.classList.remove('d-none')
        } else {
            this.form.submit();
        };
        
    },
    checkStreet(address) {
        let viaControl = false
        const vie = [
            'via', 'piazza', 'largo', 'strada', 'stradone', 'contrada', 'rione', 'circonvallazione', "ca'", 'vicolo','vicoletto'
        ]

        vie.forEach((via) => {
            if (address.toLowerCase().includes(via)) {
                viaControl = true
            }
        });
        return viaControl
    },
    checkNumber(address) {
        let numControl = false
        const numbers = [
            0, 1, 2, 3, 4, 5, 6, 7, 8, 9
        ]

        numbers.forEach((num) => {
            if (address.includes(num)) {
                numControl = true
            }
        });
        return numControl
    },
    checkVat(vat) {
        if (vat.length === 11) {
            return true
        } else {
            return false
        }
    },
    boxControl(array) {
        let control = false
        array.forEach((box) => {
            if (box.checked === true) {
                console.log(box)
                control = true
            }
        })
        return control
    },
    checkName(text) {
        nameControl = true

        if(text.length > 100 || text.length < 2) {
            nameControl = false
        }

        return nameControl
    }
}

const restaurantSubmitBtn = document.querySelector('.restaurant-submit')

if (restaurantSubmitBtn) {
    restaurantSubmitBtn.addEventListener('click', window.restaurantValidation.controlAndConfirm)
}
