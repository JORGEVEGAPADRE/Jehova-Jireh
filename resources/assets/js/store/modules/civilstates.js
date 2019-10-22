import axios from 'axios'

const state = {
    civilstates: []
}

const mutations = {
    GET_CIVILSTATES(state, civilstates) {
        state.civilstates = civilstates.reverse()
    },

    ADD_CIVILSTATE(state, civilstate) {
        state.civilstates.unshift(civilstate)
    },
    EDIT_CIVILSTATE(state, civilstateToEdit) {

        state.civilstates = state.civilstates;
    },

    DELETE_CIVILSTATE(state, civilstateToDelete) {
        state.civilstates = state.civilstates.filter(civilstate => civilstate.id != civilstateToDelete.id);
    }
}

const actions = {

    getCivilStates({ commit }) {

        return new Promise((resolve, reject) => {

            axios.get('/api/civilstates')

            .then((res) => {

                    commit('GET_CIVILSTATES', res.data.data)
                    resolve()
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    },

    addCivilState({ commit }, civilstate) {
        return new Promise((resolve, reject) => {
            commit('ADD_CIVILSTATE', civilstate)
            resolve()
        }, error => console.log(error))
    },
    editCivilState({ commit }, civilstate) {
        return new Promise((resolve, reject) => {
            //${bank.id}`/api/banks/${bank.id}`            
            axios.put(`/api/civilstates/${civilstate.id}`, civilstate)
                .then((response) => {
                    commit('EDIT_CIVILSTATE', civilstate)
                    resolve(response)
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    },
    deleteCivilState({ commit }, civilstate) {
        return new Promise((resolve, reject) => {
            axios.delete('/api/civilstates/' + civilstate.id)
                .then((response) => {
                    commit('DELETE_CIVILSTATE', civilstate)
                    resolve(response)
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    }
}

const getters = {
    civilstates: (state) => {
        return state.civilstates
    }
}


export default {
    state,
    mutations,
    actions,
    getters
}