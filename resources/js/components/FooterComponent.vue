<template>
    <footer class="p-5">
        <div class="text-center my-2 text-light">
            Made with tante bestemmie by:
        </div>
            <div class="social-menu">
                <ul>
                    <li><a href="https://github.com/naiadidub" target="blank"><i class="fab fa-github"></i></a></li>
                    <li><a href="https://github.com/DennisGambini" target="blank"><i class="fab fa-github"></i></a></li>
                    <li><a href="https://github.com/giuseppecantafio" target="blank"><i class="fab fa-github"></i></a></li>
                    <li><a href="https://github.com/Gabriel-Amar"><i class="fab fa-github" target="blank"></i></a></li>
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
    transition: .3s;
    color: #000;
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
    background-color: rgba(0, 0, 0, 0.829);
}
.social-menu ul li:nth-child(2) a:hover{
    background-color: #E4405F;
}
.social-menu ul li:nth-child(3) a:hover{
    background-color: #0077b5;
}
.social-menu ul li:nth-child(4) a:hover{
    background-color: rgb(0, 181, 3);
}
</style>