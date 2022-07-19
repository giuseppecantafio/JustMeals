<template>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="#"
                            >Home</a
                        >
                        <a class="nav-link" href="#">Features</a>
                        <router-link
                            class="nav-link"
                            :to="{ name: 'restaurants' }"
                        >
                            Restaurants
                        </router-link>
                        <router-link class="nav-link" :to="{ name: 'cart' }">
                            <i class="fa-solid fa-cart-arrow-down"></i>
                        </router-link>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    name: "HeaderComponent",
};
</script>

<style lang="scss" scoped></style>
