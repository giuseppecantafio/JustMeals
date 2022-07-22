<template>
    <header>
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="/">Inserire Logo</a>
                <div class="d-flex gap">
                    <i class="fa-solid fa-house"></i>
                    <div class="position-relative">
                        <a class="nav-link" aria-current="page" href="/">
                            Home
                        </a>
                    </div>
                    <i class="fa-solid fa-burger "></i>
                    <div class="position-relative">
                        <router-link class="nav-link" :to="{ name: 'restaurants' }">
                            Restaurants
                        </router-link>
                    </div>
                    <i class="fa-solid fa-cog"></i>
                    <div class="position-relative">
                        <a class="nav-link" href="/admin">
                            <span>Dashboard</span>
                        </a>
                    </div>
                </div>
                <div class="bottone-storto">
                    <div class="btn p-1 pos">Carrello</div>
                    <div class="prospettiva">
                        <router-link class="storto btn" :to="{ name: 'cart' }">
                            <span style="color: transparent;">Carrello</span>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    name: "HeaderComponent",
    methods:{
        goToLogin(){
            window.location.href = "/login";
        }
    }
};
</script>

<style lang="scss" scoped>
@import '../../sass/front.scss';

header{
    padding: 20px;

    .nav-link:after {    
        background: none repeat scroll 0 0 transparent;
        bottom: 5%;
        content: "";
        display: block;
        height: 2px;
        left: 0%;
        position: absolute;
        background: rgba(70, 0, 0, 0.628);
        transition: width 0.3s ease 0s, left 0.3s ease 0s;
        width: 0;
    }
    .nav-link:hover:after { 
        width: 100%; 
        right: 0; 
    }
    a{
        color: black;
        text-decoration: none;
        padding: 0 !important;
    }
    a:hover{
        color: black;
    }
    .gap{
        gap: 15px;
        border-right: 2px solid rgba(219, 113, 113, 0.49);
        padding-right: 10px;
    }
    i{
        font-size: $font-xl;
        border-left: 2px solid rgba(219, 113, 113, 0.49);
        padding-left: 10px;
    }
    .prospettiva{
        perspective: 100px;
    }
    .storto{
        border: 1px solid black;
        transform: rotateY(-9deg) rotateX(-11deg) rotateZ(-1deg) translateX(-8px);
        transition: transform 0.5s;
        padding: 12px !important;
    }
    .storto:hover{
        transform: none;
    }
    .pos{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .bottone-storto{
        position: relative;
    }
}
</style>
