<template>
    <div class="links">
        <div class="links__list" v-if="isFetching">
            <content-loader
                height="200"
                speed="2"
                primaryColor="#ffffff"
                secondaryColor="#f3f3f3"
            >
                <rect x="5" y="6" rx="3" ry="3" width="76" height="11" />
                <rect x="5" y="27" rx="3" ry="3" width="350" height="50" />
                <rect x="5" y="85" rx="3" ry="3" width="350" height="50" />
                <rect x="5" y="143" rx="3" ry="3" width="350" height="50" />
            </content-loader>
        </div>
        <div class="links__list" v-if="urls.length">
            <div class="links__item" >
                <div class="links__item-date">{{ urls.length }} Links</div>
            </div>
            <div
                v-for="(url, index) in urls"
                :key="index"
                class="links__item"
                @click="handleViewUrl(url.id)"
                :class="{ 'links__item--active' : (url.id === activeUrl.id) }"
            >
                <div class="links__item-date">{{ url.date }}</div>
                <div class="links__item-long">{{ url.title }}</div>
                <div class="links__item-short">{{ url.short_url_full }}</div>
                <div class="links__item-total">Clicks: {{ url.total_click }}</div>
            </div>
        </div>
        <div class="links__list" v-else-if="!isFetching">
            <div class="links__item" >
                <div class="links__item-date">0 Links</div>
            </div>
            <div class="links__item" >
                <div class="links__item-long">No items found.</div>
            </div>
        </div>

        <div class="links__details" v-if="isFetching">
            <content-loader
                height="200"
                speed="2"
                primaryColor="#f3f3f3"
                secondaryColor="#ecebeb"
            >
                <rect x="5" y="27" rx="3" ry="3" width="150" height="11" />
                <rect x="5" y="6" rx="3" ry="3" width="85" height="11" />
                <rect x="5" y="48" rx="3" ry="3" width="250" height="11" />
                <rect x="5" y="115" rx="3" ry="3" width="799" height="175" />
                <rect x="5" y="69" rx="3" ry="3" width="100" height="11" />
                <rect x="5" y="90" rx="0" ry="0" width="30" height="15" />
                <rect x="38" y="90" rx="0" ry="0" width="30" height="15" />
            </content-loader>
        </div>
        <div class="links__details" v-if="Object.keys(activeUrl).length">
            <div class="links__details-date">{{ activeUrl.dateTime }}</div>
            <div class="links__details-title" v-if="activeUrl.title_original">{{ activeUrl.title_original }}</div>
            <div class="links__details-long">{{ activeUrl.long_url }}</div>
            <div class="links__details-short">
                <div class="details-short__url"><a :href="activeUrl.short_url_full" target="_blank">{{appUrl}}<span class="text-bold">{{ activeUrl.short_url }}</span></a></div>
                <div class="details-short__actions">
                    <button v-clipboard:copy="activeUrl.short_url_full">Copy</button>
                    <button @click="handleShowEditUrl">Edit</button>
                </div>
            </div>
            <div class="links__details-click">
                <div class="details-click__total">Total Click: {{ activeUrl.total_click }}</div>
                <div class="details-click__graph"></div>
            </div>
            <click-chart :labels="chartLabels" :data="chartData"/>
        </div>
    </div>
</template>

<script>
import Vue from 'vue';
import { mapState } from 'vuex';
import { APP_URL } from '../constant.js';
import { FETCH_URLS, FETCH_ACTIVE_URL } from "../store/ActionTypes.js";
import VueClipboard from 'vue-clipboard2';
import ClickChart from './ClickChart';
import { ContentLoader } from "vue-content-loader";

VueClipboard.config.autoSetContainer = true;
Vue.use(VueClipboard);

export default {
    name: 'Links',
    components: {
        ClickChart,
        ContentLoader,
    },
    data() {
        return {
            appUrl: APP_URL + '/',
        };
    },
    methods: {
        handleViewUrl(urlID) {
            this.$store.dispatch(FETCH_URLS, false);
            this.$store.dispatch(FETCH_ACTIVE_URL, urlID);
        },
        handleShowEditUrl() {
            this.$emit('showEditUrl');
        },
    },
    mounted() {
        this.$store.dispatch(FETCH_URLS);
    },
    computed: {
        ...mapState({
            urls: state => state.urls.urls,
            activeUrl: state => state.urls.activeUrl,
            isFetching: state => state.urls.isFetching,
        }),
        chartLabels: {
            get() {
                return this.activeUrl.clicksFor30days.labels;
            }
        },
        chartData: {
            get() {
                return this.activeUrl.clicksFor30days.data;
            }
        },
    },
}
</script>
