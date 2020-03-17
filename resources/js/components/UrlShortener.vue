<template>
    <div class="url-shortener container">
        <h1 class="url-shortener__title">CHIBI URL</h1>
        <div class="url-shortener__url-section">
            <input type="url" class="url-shortener__link" placeholder="http://" v-model="fields.long_url">
            <button
                class="url-shortener__action"
                @click="createShortUrl"
                :disabled=button.isDisabled
            >{{ button.name }}</button>
        </div>
        <messages-list :items="messages.long_url" :isSuccess="isSuccess"/>
    </div>
</template>

<script>
import MessagesList from './MessagesList';
import { FETCH_URLS } from "../store/ActionTypes.js";

export default {
    name: 'UrlShortener',
    components: {
        MessagesList,
    },
    data() {
        return  {
            messages: {
                long_url: []
            },
            fields: {
                long_url: '',
            },
            button: {
                name: 'Create',
                isDisabled: false,
            },
            isLoggedIn: false,
            isSuccess: false,
        };
    },
    methods: {
        createShortUrl() {
            let that = this;

            if (that.isLoggedIn) {
                that.button.name = 'Creating...';
                that.button.isDisabled = true;
                axios.post('api/urls', {
                    long_url: that.fields.long_url,
                })
                .then(response => {
                    that.isSuccess = true;

                    that.messages.long_url = [response.data.message];

                    that.fields.long_url = '';

                    that.button.name = 'Create';
                    that.button.isDisabled = false;

                    that.$store.dispatch(FETCH_URLS);
                }).catch(function (error) {
                    that.isSuccess = false;

                    that.messages.long_url = error.response.data.errors.long_url ? error.response.data.errors.long_url : error.response.data.message;
                    that.button.name = 'Create';
                    that.button.isDisabled = false;
                });
            } else {
                that.messages.long_url = ["Please login to create short URL."];
            }
        }
    },
    mounted() {
        this.isLoggedIn = window.laravel.isLoggedIn;
    }
}
</script>
