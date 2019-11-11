import axios from 'axios'
const state = {
    churchjobs: [],
    hierarchyoptions: []
}
const mutations = {

    GET_HIERARCHYOPTIONS(state, hierarchyoptions) {
        state.hierarchyoptions = hierarchyoptions
    },
    GET_CHURCHJOBS(state, churchjobs) {
        state.churchjobs = churchjobs.reverse()
    },
    ADD_CHURCHJOB(state, churchjob) {
        state.churchjobs.unshift(churchjob)
    },
    EDIT_CHURCHJOB(state, churchjobToEdit) {
        state.churchjobs = state.churchjobs;
    },
    DELETE_CHURCHJOB(state, churchjobToDelete) {
        state.churchjobs = state.churchjobs.filter(churchjob => churchjob.id != churchjobToDelete.id);
    }
}
const actions = {

    getChurchJobs({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get('/api/churches')
                .then((response) => {
                    commit('GET_CHURCHJOBS', response.data.data)
                    resolve()
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    },

    getHierarchyOptions({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get('/api/churches/hierarchies')
                .then((response) => {
                    commit('GET_HIERARCHYOPTIONS', response.data.data)
                    resolve()
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    },
    addChurchJob({ commit }, churchjob) {
        return new Promise((resolve, reject) => {
            commit('ADD_CHURCHJOB', churchjob)
            resolve()
        }, error => console.log(error))
    },
    editChurchJob({ commit }, churchjob) {
        return new Promise((resolve, reject) => {
            axios.put(`/api/churches/${churchjob.id}`, churchjob)
                .then((response) => {
                    commit('EDIT_CHURCHJOB', churchjob)
                    resolve(response)
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    },
    deleteChurchJob({ commit }, churchjob) {
        return new Promise((resolve, reject) => {
            axios.delete(`/api/churches/${churchjob.id}`, churchjob)
                .then((response) => {
                    commit('DELETE_CHURCHJOB', churchjob)
                    resolve(response)
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    }
}

const getters = {
    churchjobs: (state) => {
        return state.churchjobs
    },
    hierarchyoptions: (state) => {
        return state.hierarchyoptions
    }
}


export default {
    state,
    mutations,
    actions,
    getters
}