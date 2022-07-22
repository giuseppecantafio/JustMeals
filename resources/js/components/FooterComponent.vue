<template>
    <footer>
        <h1>
            <button class="stocazzo">
                <a href="">ciao</a>
            </button>
        </h1>
    </footer>
</template>

<script>
export default {
    name:'FooterComponent',

}
</script>

<style lang="scss" scoped>

@import '../../sass/front.scss';

button{
    @include bottoneStrafico;
}


</style>