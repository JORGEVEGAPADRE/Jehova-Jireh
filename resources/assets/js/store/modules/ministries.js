import axios from 'axios'

const state = {
    ministries: []
}

const mutations = {
    GET_MINISTRIES(state, ministries) {
        state.ministries = ministries.reverse()
    },

    ADD_MINISTRY(state, ministry) {
        state.ministries.unshift(ministry)
    },
    EDIT_MINISTRY(state, ministryToEdit) {

        state.ministries = state.ministries;
    },

    DELETE_MINISTRY(state, ministryToDelete) {
        state.ministries = state.ministries.filter(ministry => ministry.id != ministryToDelete.id);
    }
}

const actions = {
    getMinistries({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get('/api/ministries')
                .then((response) => {
                    commit('GET_MINISTRIES', response.data.data)
                    resolve()
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    },

    addMinistry({ commit }, ministry) {
        return new Promise((resolve, reject) => {
            commit('ADD_MINISTRY', ministry)
            resolve()
        }, error => console.log(error))
    },
    editMinistry({ commit }, ministry) {
        return new Promise((resolve, reject) => {
            axios.put(`/api/ministries/${ministry.id}`, ministry)
                .then((response) => {
                    commit('EDIT_MINISTRY', ministry)
                    resolve(response)
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    },
    deleteMinistry({ commit }, ministry) {
        return new Promise((resolve, reject) => {
            axios.delete('/api/ministries/' + ministry.id)
                .then((response) => {
                    commit('DELETE_MINISTRY', ministry)
                    resolve(response)
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    }
}

const getters = {
    ministries: (state) => {
        return state.ministries
    }
}


export default {
    state,
    mutations,
    actions,
    getters
}