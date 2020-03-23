<template>
    <div class="header container">
        <div class="header__brand">
            <router-link :to="{ name: 'home' }">CHIBI URL</router-link>
        </div>
        <div class="nav" :class="{ 'nav--show' : showNav}">
            <ul class="nav__list">
                <li><router-link :to="{ name: 'about-us' }">About Us</router-link></li>
                <li><router-link :to="{ name: 'login' }" v-if="!isLoggedIn">Login</router-link></li>
                <li><router-link :to="{ name: 'register' }" v-if="!isLoggedIn">Register</router-link></li>
                <li><a href="#" v-if="isLoggedIn" @click="handleLogout">Logout</a></li>
            </ul>
        </div>
        <div class="header__burger" @click="handleBurgerClick">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Header',
    data() {
        return {
            isLoggedIn: false,
            showNav: false,
        }
    },
    methods: {
        handleLogout(e) {
            e.preventDefault();

            let that =  this;
            axios.post('api/logout').then(response => {
                location.href = '/login';
            }).catch(error => {
                alert(error.response.data.message);
            });
        },
        handleBurgerClick(e) {
            e.preventDefault();
            this.showNav = !this.showNav;
        }
    },
    mounted() {
        this.isLoggedIn = window.laravel.isLoggedIn;
    }
}
</script>
