<template>
    <div class="links">
        <div class="links__list">
            <div class="links__item">
                <div class="links__item-long">https://github.com/738/awesome-url-shortener</div>
                <div class="links__item-short">{{ siteUrl }}/sdf34df</div>
            </div>
            <div class="links__item links__item--active">
                <div class="links__item-long">https://github.com/738/awesome-url-shortener</div>
                <div class="links__item-short">{{ siteUrl }}/sdf34df</div>
            </div>
            <div class="links__item">
                <div class="links__item-long">https://github.com/738/awesome-url-shortener</div>
                <div class="links__item-short">{{ siteUrl }}/sdf34df</div>
            </div>
            <div class="links__item">
                <div class="links__item-long">https://github.com/738/awesome-url-shortener</div>
                <div class="links__item-short">{{ siteUrl }}/sdf34df</div>
            </div>
        </div>
        <div class="links__details">
            <div class="links__details-date">Mar 20, 2020</div>
            <div class="links__details-long">https://github.com/738/awesome-url-shortener</div>
            <div class="links__details-short">
                <div class="details-short__url">{{ siteUrl }}/</div>
                <div class="details-short__actions">
                    <button>Copy</button>
                    <button>Edit</button>
                    <button>Share</button>
                </div>
            </div>
            <div class="links__details-click">
                <div class="details-click__total">123</div>
                <div class="details-click__graph"></div>
            </div>
        </div>
    </div>
</template>

<script>
import {APP_URL} from '../constant.js';

export default {
    name: 'Links',
    data() {
        return {
            siteUrl: APP_URL
        }
    },
}
</script>
