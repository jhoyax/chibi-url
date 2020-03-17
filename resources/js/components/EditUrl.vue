<template>
    <div class="edit-url">
        <button class="edit-url__close" @click="handleShowEditUrl">
            <span class="edit-url__close--span1"></span>
            <span class="edit-url__close--span2"></span>
        </button>
        <div class="edit-url__form">
            <div class="form__group">
                <label>Title</label>
                <input
                    type="text"
                    class="form__field"
                    v-model="title"
                    required
                >
            </div>
            <div class="form__group">
                <label>Short URL</label>
                <div class="label-x-field">
                    <label>http://test.com/</label>
                    <input
                        type="text"
                        v-model="short_url"
                        required
                    >
                </div>
                <messages-list :items="messages.short_url"/>
            </div>
            <div class="form__group">
                <button
                    type="submit"
                    class="form__action"
                    @click="handleSave"
                >Save</button>
                <messages-list :items="messages.general" :isSuccess="isSuccess"/>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex';
import { FETCH_URLS, FETCH_ACTIVE_URL } from "../store/ActionTypes.js";
import MessagesList from './MessagesList';

export default {
    name: 'EditUrl',
    components: {
        MessagesList,
    },
    data() {
        return {
            messages: {
                general: [],
                short_url: [],
            },
            isSuccess: false,
        }
    },
    methods: {
        handleShowEditUrl() {
            // refresh data
            this.$store.dispatch(FETCH_ACTIVE_URL, this.activeUrl.id);

            this.$emit('showEditUrl');
        },
        handleSave(e) {
            e.preventDefault();

            let that = this;
            axios.patch('/api/urls/' + that.activeUrl.id, {
                title: that.activeUrl.title_original,
                short_url: that.activeUrl.short_url
            }).then(response => {
                that.isSuccess = true;

                that.messages.general = [response.data.message];
                that.messages.short_url = [];

                // refresh data
                that.$store.dispatch(FETCH_URLS, false);
            }).catch(error => {
                that.isSuccess = false;

                that.messages.general = [error.response.data.message];
                that.messages.short_url = error.response.data.errors.short_url;
            });
        },
    },
    computed: {
        ...mapState({
            activeUrl: state => state.urls.activeUrl,
        }),
        title: {
            set(title_original) {
                this.activeUrl.title_original = title_original;
                // this.$store.commit(SET_ACTIVE_URL, { title_original });
            },
            get() {
                return this.activeUrl.title_original;
            },
        },
        short_url: {
            set(short_url) {
                this.activeUrl.short_url = short_url;
            },
            get() {
                return this.activeUrl.short_url;
            },
        },
    },
}
</script>
