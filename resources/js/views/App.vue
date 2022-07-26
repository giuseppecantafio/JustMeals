<template>
    <div>
        <header-component/>
        <main-component/>
        <footer-component/>
    </div>
</template>

<script>
import FooterComponent from '../components/FooterComponent.vue'
import HeaderComponent from '../components/HeaderComponent.vue'
import MainComponent from '../components/MainComponent.vue'
export default {
    components: { HeaderComponent, MainComponent, FooterComponent},
    name: "App",
}
</script>

<style lang="scss">
@import '../../sass/front.scss';

body{
    background: #fc4a1a;  
    background: -webkit-linear-gradient(to bottom, #f7b733, #fc4a1a); 
    background: linear-gradient(to bottom, #f7b733, #fc4a1a); 
    background-repeat: no-repeat;

}

</style>