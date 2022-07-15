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
    components: { HeaderComponent, MainComponent, FooterComponent },
    name: "App",
}
</script>

<style>

</style>