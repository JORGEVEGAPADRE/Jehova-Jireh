import axios from 'axios'

const state = {
    jobstates: []
}

const mutations = {
    GET_JOBSTATES(state, jobstates) {
        state.jobstates = jobstates.reverse()
    },

    ADD_JOBSTATE(state, jobstate) {
        state.jobstates.unshift(jobstate)
    },
    EDIT_JOBSTATE(state, jobstateToEdit) {

        state.jobstates = state.jobstates;
    },

    DELETE_JOBSTATE(state, jobstateToDelete) {
        state.jobstates = state.jobstates.filter(jobstate => jobstate.id != jobstateToDelete.id);
    }
}

const actions = {
    getJobStates({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get('/api/jobstates')
                .then((response) => {
                    commit('GET_JOBSTATES', response.data.data)
                    resolve()
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    },

    addJobState({ commit }, jobstate) {
        return new Promise((resolve, reject) => {
            commit('ADD_JOBSTATE', jobstate)
            resolve()
        }, error => console.log(error))
    },
    editJobState({ commit }, jobstate) {
        return new Promise((resolve, reject) => {
            axios.put(`/api/jobstates/${jobstate.id}`, jobstate)
                .then((response) => {
                    commit('EDIT_JOBSTATE', jobstate)
                    resolve(response)
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    },
    deleteJobState({ commit }, jobstate) {
        return new Promise((resolve, reject) => {
            axios.delete('/api/jobstates/' + jobstate.id)
                .then((response) => {
                    commit('DELETE_JOBSTATE', jobstate)
                    resolve(response)
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    }
}

const getters = {
    jobstates: (state) => {
        return state.jobstates
    }
}


export default {
    state,
    mutations,
    actions,
    getters
}