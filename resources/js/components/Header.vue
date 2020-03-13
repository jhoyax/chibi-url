<template>
    <div class="header container">
        <div class="header__brand">
            <router-link :to="{ name: 'home' }">CHIBI URL</router-link>
        </div>
        <div class="nav">
            <ul class="nav__list">
                <li><router-link :to="{ name: 'about-us' }">About Us</router-link></li>
                <li><router-link :to="{ name: 'login' }" v-if="!isLoggedIn">Login</router-link></li>
                <li><router-link :to="{ name: 'register' }" v-if="!isLoggedIn">Register</router-link></li>
                <li><a href="#" v-if="isLoggedIn" v-on:click="handleLogout">Logout</a></li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Header',
    data() {
        return {
            isLoggedIn: false,
        }
    },
    methods: {
        handleLogout(e) {
            e.preventDefault();

            let that =  this;
            axios.post('api/logout').then(response => {
                location.reload();
            }).catch(error => {
                alert(error.response.data.message);
            });
        }
    },
    mounted() {
        this.isLoggedIn = window.laravel.isLoggedIn;
    }
}
</script>
