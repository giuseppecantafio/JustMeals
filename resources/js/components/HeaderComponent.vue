<template>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <!-- Add logo -->
                <div > 
                    <a href="/"><img src="storage/uploads/Justmeals-blue-su-dark-orange.png" alt="" class="jumbo-logo"></a>
                    
                </div>
                <!-- Responsive Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar Items -->
                    <ul class="navbar-nav gap mx-auto mb-2 mb-lg-0">
                        <li class="d-flex">
                            <a aria-current="page" class="mx-2" href="/">
                                <i class="fa-solid fa-house"></i>
                            </a>
                            <div class="position-relative">
                                <a class="nav-item" aria-current="page" href="/">
                                    Home
                                </a>
                            </div>
                        </li>
                        <li class="d-flex ">
                            <a href="/restaurants" class="mx-2">
                                <i class="fa-solid fa-burger "></i>
                            </a>
                            <div class="position-relative">
                                <router-link class="nav-item" :to="{ name: 'restaurants' }">
                                    Restaurants
                                </router-link>
                            </div>
                        </li>
                        <li class="d-flex">
                            <a href="/admin" class="mx-2">
                                <i class="fa-solid fa-cog"></i>
                            </a>
                            <div class="position-relative">
                                <a class="nav-item" href="/admin">
                                    <span>Dashboard</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <!--  -->
                    <!-- Navbar cart -->
                    <div class="d-flex">
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
            </div>
        </nav>
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
    
    .nav-item:after {    
        background: none repeat scroll 0 0 transparent;
        bottom: 17%;
        content: "";
        display: block;
        height: 2px;
        left: 0%;
        position: absolute;
        background: rgba(255, 255, 255, 0.628);
        transition: width 0.3s ease 0s, left 0.3s ease 0s;
        width: 0;
    }
    .nav-item:hover:after { 
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
        text-decoration: none;
    }
    .gap{
        gap: 15px;
        border-right: 2px solid rgba(255, 255, 255, 0.49);
        padding-right: 10px;
    }
    i{
        font-size: $font-xl;
        border-left: 2px solid rgba(255, 255, 255, 0.49);
        padding-left: 10px;
        cursor: pointer;
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
    .navbar-light .navbar-toggler-icon {
        background-image: url("/storage/uploads/icon-wrap-23.jpg");
    }
    .navbar-toggler-icon{
        width: 50px;
        height: 50px;
    }
    .navbar-toggler{
        border: none;
    }
}
// #jumbo-img {
//   display: inline-block;
//   margin: 0 0.5rem;

//   animation: bounce; /* referring directly to the animation's @keyframe declaration */
//   animation-duration: 2.5s; /* don't forget to set a duration! */
// }
.jumbo-logo{
  width: 200px;
  height: 75px;
//   padding-bottom: 10px;
}
</style>
