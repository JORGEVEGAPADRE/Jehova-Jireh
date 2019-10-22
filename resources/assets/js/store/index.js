import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import auth from './modules/auth'
import banks from './modules/banks'
import jobstates from './modules/jobstates'
import civilstates from './modules/civilstates'
import members from './modules/members'
import churchjobs from './modules/churchjobs'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        auth,
        banks,
        jobstates,
        civilstates,
        members,
        churchjobs
    },
    plugins: [createPersistedState()]
})