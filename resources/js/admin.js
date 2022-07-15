/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

console.log('ricaricato')

const checkAddress = document.querySelector('.check-address');

checkAddress.addEventListener("click", function (event) {

    event.preventDefault();

    const address = document.getElementById('address');
    const formAddress = document.querySelector('.form-js');


    // validazioni di address
    let numbers = [
        0, 1, 2, 3, 4, 5, 6, 7, 8, 9
    ];

    let vie = [
        'Via', 'Piazza', 'Largo', 'Strada', 'Stradone', 'Contrada', 'Rione', 'Circonvallazione', "Ca'"
    ];

    let numberChecked = false;
    let viaChecked = false;

    numbers.forEach((number) => {
        if (address.value.includes(number)) {
            numberChecked = true;
        }
    });

    vie.forEach((via) => {
        if (address.value.includes(via)) {
            viaChecked = true;
        }
    });

    // validazione VAT

    const vat = document.getElementById('vat');
    let vatChecked = false;
    if (vat.value.length === 11) {
        vatChecked = true;
    }


    const vatError = document.querySelector('.vat-error')
    const viaAddressError = document.querySelector('.viaAddress-error')
    const numberAddressError = document.querySelector('.numberAddress-error')
    const typologyError = document.querySelector('.typology-error')

    viaAddressError.classList.add('d-none')
    vatError.classList.add('d-none')
    numberAddressError.classList.add('d-none')
    typologyError.classList.add('d-none')

    // validazione checkbox
    const checkBoxes = document.querySelectorAll('input[type=checkbox')
    let checkChecked = false
    checkBoxes.forEach((checkBox) => {
        if (checkBox.checked === true) {
            checkChecked = true
        }
    })

    // submit
    if (viaChecked === false) {
        viaAddressError.classList.remove('d-none')
    } else if(numberChecked === false) {
        numberAddressError.classList.remove('d-none')
    } else if (vatChecked === false) {
        vatError.classList.remove('d-none')
    } else if (checkChecked === false) {
        typologyError.classList.remove('d-none')
    } else {
        formAddress.submit();
    };
    

});