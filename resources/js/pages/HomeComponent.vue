<template>
    <div>
        <h1>Benvenuto su Deliveboo!</h1>
        <router-link :to="{ name: 'daclelia' }"
            >Vai al menù del ristorante da Clelia</router-link
        >
    </div>
</template>

<script>
export default {
    components: {},
    name: "HomeComponent",
};
</script>

<style lang="scss" scoped></style>
