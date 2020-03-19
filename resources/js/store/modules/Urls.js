import axios from 'axios';
import { FETCH_URLS, FETCH_ACTIVE_URL } from '../ActionTypes';
import { SET_URLS, SET_ACTIVE_URL, SET_URL_IS_FETCHING } from '../Mutations';

export const state = {
    urls: [],
    activeUrl: {},
    isFetching: true,
};

export const actions = {
    [FETCH_URLS]({ commit}, resetActiveUrl = true) {
        return axios
            .get('/api/urls')
            .then(response => {
                commit(SET_URLS, response.data.data)

                // set active url
                if (response.data.data.length && resetActiveUrl) {
                    commit(SET_ACTIVE_URL, response.data.data[0])
                }

                commit(SET_URL_IS_FETCHING, false);
            })
            .catch(error => {
                commit(SET_URL_IS_FETCHING, false);
                throw(error);
            });
    },
    [FETCH_ACTIVE_URL]({commit}, urlID){
        return axios
            .get('/api/urls/' + urlID)
            .then(response => {
                commit(SET_ACTIVE_URL, response.data.data);
            })
            .catch(error => {
                throw(error);
            });
    },
};

export const mutations = {
    [SET_URLS](state, urls) {
        state.urls = urls;
    },
    [SET_ACTIVE_URL](state, activeUrl) {
        state.activeUrl = activeUrl;
    },
    [SET_URL_IS_FETCHING](state, isFetching) {
        state.isFetching = isFetching;
    },
};

export default {
    state,
    actions,
    mutations,
  };
