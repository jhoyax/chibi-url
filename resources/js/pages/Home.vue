<template>
    <div class="home-section">
        <url-shortener/>
        <links v-if="isLoggedIn"/>
        <login-modal v-if="!isLoggedIn"/>
    </div>
</template>
<script>
import UrlShortener from '../components/UrlShortener';
import Links from '../components/Links';
import LoginModal from '../components/LoginModal';

export default {
    name: 'Home',
    components: {
        Links,
        UrlShortener,
        LoginModal,
    },
    data() {
        return {
            isLoggedIn: false,
        };
    },
    mounted() {
        this.isLoggedIn = window.laravel.isLoggedIn;
    }
}
</script>
