<template>
    <div>
        <p v-for="item in items" :key="item.id">
            {{item.name}}
        </p>
    </div>
</template>

<script>
export default {
    name: "MenuComponent",
    data(){
        return{
            items: [],
        }
    },
    created(){
        const slug = this.$route.params.slug;
        axios.get(`/api/restaurants/${slug}`).then((response)=>{
            this.items = response.data.items;
            //console.log(this.items);
        }).catch((error)=>{
            console.log(error);
        });
    }
}
</script>

<style lang="scss" scoped>

</style>