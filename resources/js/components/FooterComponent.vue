<template>
    <footer>
        <div class="text-center my-2 text-light">
            Made by:
        </div>
            <!-- Footer links -->
            <div class="social-menu">
                <ul>
                    <li class="d-flex flex-column align-items-center py-1 text-light"><a href="https://github.com/naiadidub" target="blank"><i style="color: rgba(248, 219, 0, 0.829);" class="fab fa-github"></i></a>Antonio</li>
                    <li class="d-flex flex-column align-items-center py-1 text-light"><a href="https://github.com/DennisGambini" target="blank"><i style="color: #E4405F;" class="fab fa-github "></i></a>Dennis</li>
                    <li class="d-flex flex-column align-items-center py-1 text-light"><a href="https://github.com/giuseppecantafio" target="blank"><i  style="color: #0077b5;" class="fab fa-github "></i></a>Giuseppe</li>
                    <li class="d-flex flex-column align-items-center py-1 text-light"><a href="https://github.com/Gabriel-Amar"><i style="color: rgb(0, 181, 3);" class="fab fa-github" target="blank "></i></a>Gabriel</li>
                </ul>
            </div>        
    </footer>
</template>

<script>
export default {
    name:'FooterComponent',

}
</script>

<style lang="scss" scoped>
@import '../../sass/front.scss';

footer{
    background-color: rgb(50, 50, 50);
    height: 150px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 17px;
    }

.social-menu ul{
    display: flex;
    justify-content: center;
}

.social-menu ul li{
    list-style: none;
    margin: 0 15px;
}

.social-menu ul li .fab{
    font-size: 30px;
    line-height: 40px;
    transition: .2s;
}


.social-menu ul li .fab:hover{
    color: #fff;
}

.social-menu ul li a{
    position: relative;
    display: block;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #fff;
    text-align: center;
    transition: .6s;
    box-shadow: 0 5px 4px rgba(0,0,0,.5);
}

.social-menu ul li a:hover{
    transform: translate(0, -10%);
}

.social-menu ul li:nth-child(1) a:hover{
    background-color: rgba(248, 219, 0, 0);
}
.social-menu ul li:nth-child(2) a:hover{
    background-color: #e4405e00;
}
.social-menu ul li:nth-child(3) a:hover{
    background-color: #0076b500;
}
.social-menu ul li:nth-child(4) a:hover{
    background-color: rgba(0, 181, 3, 0);
}
</style>