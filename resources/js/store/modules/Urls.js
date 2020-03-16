import axios from 'axios';
import { FETCH_URLS, FETCH_ACTIVE_URL } from '../ActionTypes';
import { SET_URLS, SET_ACTIVE_URL } from '../Mutations';

export const state = {
    urls: [],
    activeUrl: {},
};

export const actions = {
    [FETCH_URLS]({ commit}) {
        return axios
            .get('/api/urls')
            .then(response => {
                commit(SET_URLS, response.data.data)

                // set active url
                if (response.data.data.length) {
                    commit(SET_ACTIVE_URL, response.data.data[0])
                }
            })
            .catch(error => {
                throw(error);
            });
    },
    [FETCH_ACTIVE_URL]({commit}, urlID){
        return axios
            .get('/api/urls/' + urlID)
            .then(response => {
                commit(SET_ACTIVE_URL, response.data.data)
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
};

export default {
    state,
    actions,
    mutations,
  };
