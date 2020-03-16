<template>
    <div class="links">
        <div class="links__list" v-if="urls.length">
            <div
                v-for="(url, index) in urls"
                :key="index"
                class="links__item"
                @click="handleViewUrl(url.id)"
            >
                <div class="links__item-date">{{ url.date }}</div>
                <div class="links__item-long">{{ url.long_url }}</div>
                <div class="links__item-short">{{ url.short_url_full }}</div>
            </div>
        </div>
        <div class="links__list" v-else>
            <div class="links__item" >
                <div class="links__item-long">No items found.</div>
            </div>
        </div>
        <div class="links__details" v-if="Object.keys(activeUrl).length">
            <div class="links__details-date">{{ activeUrl.dateTime }}</div>
            <div class="links__details-long">{{ activeUrl.long_url }}</div>
            <div class="links__details-short">
                <div class="details-short__url"><a :href="activeUrl.short_url_full" target="_blank">{{appUrl}}<span class="text-bold">{{ activeUrl.short_url }}</span></a></div>
                <div class="details-short__actions">
                    <button v-clipboard:copy="activeUrl.short_url_full">Copy</button>
                    <button>Edit</button>
                    <button>Share</button>
                </div>
            </div>
            <div class="links__details-click">
                <div class="details-click__total">{{ activeUrl.total_clicks }}</div>
                <div class="details-click__graph"></div>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue';
import { mapState } from 'vuex';
import { APP_URL } from '../constant.js';
import { FETCH_URLS, FETCH_ACTIVE_URL } from "../store/ActionTypes.js";
import VueClipboard from 'vue-clipboard2';

VueClipboard.config.autoSetContainer = true;
Vue.use(VueClipboard);

export default {
    name: 'Links',
    data() {
        return {
            appUrl: APP_URL + '/'
        };
    },
    methods: {
        handleViewUrl(urlID) {
            this.$store.dispatch(FETCH_ACTIVE_URL, urlID);
        },
    },
    mounted() {
        this.$store.dispatch(FETCH_URLS);
    },
    computed: {
        ...mapState({
            urls: state => state.urls.urls,
            activeUrl: state => state.urls.activeUrl,
        })
    },
}
</script>
