<template>
    <div class="section section--center">
        <form class="form">
            <div class="form__group">
                <h1 class="form__title">Register to create new account.</h1>
            </div>
            <div class="form__group">
                <label>Name</label>
                <input type="text" class="form__field" v-model="fields.name" required maxlength="255"/>
                <messages-list :items="messages.name"/>
            </div>
            <div class="form__group">
                <label>Email</label>
                <input type="email" class="form__field" v-model="fields.email" required maxlength="255"/>
                <messages-list :items="messages.email"/>
            </div>
            <div class="form__group">
                <label>Password</label>
                <input type="password" class="form__field" v-model="fields.password" required/>
                <messages-list :items="messages.password"/>
            </div>
            <div class="form__group">
                <label>Confirm Password</label>
                <input type="password" class="form__field" v-model="fields.password_confirmation" required/>
            </div>
            <div class="form__group">
                <button
                    type="submit"
                    class="form__action"
                    @click="handleSubmit"
                >Register</button>
                <messages-list :items="messages.general" :isSuccess="isSuccess"/>
            </div>
            <div class="form__group">
                Already have an account? <router-link :to="{ name: 'login' }">Login here</router-link>.
            </div>
        </form>
    </div>
</template>

<script>
import MessagesList from '../components/MessagesList';

export default {
    name: 'Register',
    components: {
        MessagesList,
    },
    data() {
        return {
            messages: {
                general: [],
                name: [],
                email: [],
                password: [],
            },
            fields: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            },
            isSuccess: false,
        }
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault();

            let that = this;
            axios.post('/api/register', {
                name: this.fields.name,
                email: this.fields.email,
                password: this.fields.password,
                password_confirmation: this.fields.password_confirmation,
            }).then(response => {
                that.messages.general = [response.data.message];
                that.messages.name = [];
                that.messages.email = [];
                that.messages.password = [];
                that.isSuccess = true;

                that.fields.name = '';
                that.fields.email = '';
                that.fields.password = '';
                that.fields.password_confirmation = '';
            }).catch(error => {
                that.messages.general = [error.response.data.message];
                that.messages.name = error.response.data.errors.name;
                that.messages.email = error.response.data.errors.email;
                that.messages.password = error.response.data.errors.password;
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
