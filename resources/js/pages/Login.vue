<template>
    <div class="section section--center">
        <form class="form" method="POST" action="/login">
            <div class="form__group">
                <h1 class="form__title">Login to your account.</h1>
            </div>
            <div class="form__group">
                <label>Email</label>
                <input type="email" class="form__field" v-model="fields.email" required/>
                <messages-list v-bind:items="messages.email"/>
            </div>
            <div class="form__group">
                <label>Password</label>
                <input type="password" class="form__field" v-model="fields.password" required/>
                <messages-list v-bind:items="messages.password"/>
            </div>
            <div class="form__group">
                <button
                    type="submit"
                    class="form__action"
                    v-on:click="handleSubmit"
                >Login</button>
                <messages-list v-bind:items="messages.general" v-bind:isSuccess="isSuccess"/>
            </div>
            <div class="form__group">
                No account yet? <router-link :to="{ name: 'register' }">Register now</router-link>.
            </div>
        </form>
    </div>
</template>

<script>
import MessagesList from '../components/MessagesList';

export default {
    name: 'Login',
    components: {
        MessagesList,
    },
    data() {
        return {
            messages: {
                general: [],
                email: [],
                password: [],
            },
            fields: {
                email: '',
                password: '',
            },
            isSuccess: false,
        }
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault();

            let that = this;
            axios.get('/airlock/csrf-cookie').then(response => {
                axios.post('api/login', {
                    email: this.fields.email,
                    password: this.fields.password
                }).then(response => {
                    that.messages.general = [response.data.message];
                    that.messages.email = [];
                    that.messages.password = [];
                    that.isSuccess = true;

                    that.fields.email = '';
                    that.fields.password = '';

                    location.reload();
                }).catch(error => {
                    that.messages.general = [error.response.data.message];
                    that.messages.email = error.response.data.errors.email;
                    that.messages.password = error.response.data.errors.password;
                });
            });
        }
    },
    beforeRouteEnter (to, from, next) {
        if (window.laravel.isLoggedIn) {
            return next('/');
        }
        next();
    }
}
</script>
