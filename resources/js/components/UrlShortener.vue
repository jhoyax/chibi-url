<template>
    <div class="url-shortener container">
        <h1 class="url-shortener__title">CHIBI URL</h1>
        <div class="url-shortener__url-section">
            <input type="url" class="url-shortener__link" placeholder="http://" v-model="fields.long_url">
            <button
                class="url-shortener__action"
                v-on:click="createShortUrl"
                v-bind:disabled=button.isDisabled
            >{{ button.name }}</button>
        </div>
        <messages-list v-bind:items="messages.long_url" v-bind:isSuccess="isSuccess"/>
    </div>
</template>

<script>
import MessagesList from './MessagesList';

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

            if (this.isLoggedIn) {
                that.button.name = 'Creating...';
                that.button.isDisabled = true;
                that.isSuccess = false;
                that.messages.long_url = [];

                axios.post('api/urls', {
                    long_url: that.fields.long_url,
                })
                .then(response => {
                    that.messages.long_url = [response.data.message];
                    that.fields.long_url = '';
                    that.button.name = 'Create';
                    that.button.isDisabled = false;
                    that.isSuccess = true;
                }).catch(function (error) {
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
