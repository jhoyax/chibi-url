<template>
    <div class="home-section">
        <url-shortener/>
        <links v-if="isLoggedIn" @showEditUrl="handleShowEditUrl"/>
        <login-modal v-if="!isLoggedIn"/>
        <edit-url v-if="showEditUrl" @showEditUrl="handleShowEditUrl"/>
    </div>
</template>
<script>
import UrlShortener from '../components/UrlShortener';
import Links from '../components/Links';
import LoginModal from '../components/LoginModal';
import EditUrl from '../components/EditUrl';

export default {
    name: 'Home',
    components: {
        Links,
        UrlShortener,
        LoginModal,
        EditUrl,
    },
    data() {
        return {
            isLoggedIn: false,
            showEditUrl: false,
        };
    },
    methods: {
        handleShowEditUrl() {
            this.showEditUrl = !this.showEditUrl;
        },
    },
    mounted() {
        this.isLoggedIn = window.laravel.isLoggedIn;
    }
}
</script>
