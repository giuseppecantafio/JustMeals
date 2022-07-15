/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

const checkAddress = document.querySelector('.check-address');

checkAddress.addEventListener("click", function (event) {

    event.preventDefault();

    const address = document.getElementById('address');
    const formAddress = document.getElementsByTagName('form');


    // validazioni di address
    let numbers = [
        0, 1, 2, 3, 4, 5, 6, 7, 8, 9
    ];
    console.log(numbers);

    let vie = [
        'Via', 'Piazza', 'Largo', 'Strada', 'Stradone', 'Contrada', 'Rione', 'Circonvallazione', "Ca'"
    ];
    console.log(vie);

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

    if (viaChecked && numberChecked) {

        formAddress[0].submit();

    } else {
        console.log("LEONARODOSODS")
    };
});