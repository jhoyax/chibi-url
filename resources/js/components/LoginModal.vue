<template>
    <div class="modal">
        <div class="modal__content">
            <div class="modal__title">
                <h1>Get Started for Free</h1>
            </div>
            <div class="modal__body">
                <ul>
                    <li><router-link :to="{ name: 'login' }">Login</router-link></li>
                    <li><router-link :to="{ name: 'register' }">Register</router-link></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'LoginModal'
}
</script>
