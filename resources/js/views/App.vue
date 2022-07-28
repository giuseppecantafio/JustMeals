<template>
    <div>
        <header-component class="header" />
        <main-component class="main" />
        <footer-component class="footer" />
    </div>
</template>

<script>
import FooterComponent from "../components/FooterComponent.vue";
import HeaderComponent from "../components/HeaderComponent.vue";
import MainComponent from "../components/MainComponent.vue";
export default {
    components: { HeaderComponent, MainComponent, FooterComponent },
    name: "App",
};
</script>

<style lang="scss">
@import "../../sass/front.scss";

body {
    background: $my-dark-orange;
    // background: -webkit-linear-gradient(to bottom, #f7b733, #fc4a1a);
    background: -webkit-linear-gradient(to bottom, #f7b733, #fc4a1a);
    background: linear-gradient(to bottom, $my-mustard, $my-dark-orange);
    height: 100%;
    margin: 0;
    background-repeat: no-repeat;
    background-attachment: fixed;
}
.main {
    min-height: calc(100vh - 256px);
}
.footer {
    bottom: 0;
    width: 100%;
}
button.slick-prev:before,
button.slick-next:before {
    background-color: #0d9ba3 !important;
    border-radius: 50%;
}
.slick-dots li button:before {
    font-size: 60px !important;
    color: #0d9ba3 !important;
    content: "\2212" !important;
}
.slick-dots li {
    margin: 0px 15px !important;
}
</style>
