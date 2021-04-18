import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        title: '',
        subtitle: '',
        summary: ''
    },
    mutations: {
        changeTitle(state, title) {
            state.title = title;
        },
        changeSubtitle(state, subtitle) {
            state.subtitle = subtitle;
        },
        changeSummary(state, summary) {
            state.summary = summary;
        }
    },
    getters: {
        title: state => state.title,
        subtitle: state => state.subtitle,
        summary: state => state.summary
    }
})