import axios from 'axios'

const state = {
    members: [],
    sexoptions: [],
    countryoptions: [],
    bloodtypeoptions: [],
    civilstateoptions: [],
    jobstateoptions: []
}
const mutations = {
    GET_MEMBERS(state, members) {
        state.members = members.reverse()
    },
    GET_SEXOPTIONS(state, sexoptions) {
        state.sexoptions = sexoptions
    },
    GET_COUNTRYOPTIONS(state, countryoptions) {
        state.countryoptions = countryoptions
    },
    GET_BLOODTYPEOPTIONS(state, bloodtypeoptions) {
        state.bloodtypeoptions = bloodtypeoptions
    },
    GET_CIVILSTATEOPTIONS(state, civilstateoptions) {
        state.civilstateoptions = civilstateoptions
    },
    GET_JOBSTATEOPTIONS(state, jobstateoptions) {
        state.jobstateoptions = jobstateoptions
    },
    EDIT_MEMBER(state, memberToEdit) {
        state.members = state.members;
    },
    DELETE_MEMBER(state, memberToDelete) {
        state.members = state.members.filter(member => member.id != memberToDelete.id);
    }
}

const actions = {
    getSexOptions({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get('/api/genders')
                .then((response) => {
                    commit('GET_SEXOPTIONS', response.data.data)
                    resolve()
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    },
    getCountryOptions({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get('/api/countries')
                .then((response) => {
                    commit('GET_COUNTRYOPTIONS', response.data.data)
                    resolve()
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    },
    getBloodTypeOptions({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get('/api/bloods')
                .then((response) => {
                    commit('GET_BLOODTYPEOPTIONS', response.data.data)
                    resolve()
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    },

    getCivilStateOptions({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get('/api/members/civilstates')
                .then((response) => {
                    commit('GET_CIVILSTATEOPTIONS', response.data.data)
                    resolve()
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    },
    getJobStateOptions({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get('/api/members/jobstates')
                .then((response) => {
                    commit('GET_JOBSTATEOPTIONS', response.data.data)
                    resolve()
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    },
    getMembers({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get('/api/updatemembers')
                .then((response) => {
                    commit('GET_MEMBERS', response.data.data)
                    resolve()
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    },

    editMember({ commit }, member) {
        return new Promise((resolve, reject) => {
            axios.put(`/api/updatemembers/${member.id}`, member)
                .then((response) => {
                    commit('EDIT_MEMBER', member)
                    resolve(response)
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    },
    deleteMember({ commit }, member) {
        return new Promise((resolve, reject) => {
            axios.delete('/api/updatemembers/' + member.id)
                .then((response) => {
                    commit('DELETE_MEMBER', member)
                    resolve(response)
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    }
}

const getters = {
    members: (state) => {
        return state.members
    },
    sexoptions: (state) => {
        return state.sexoptions
    },
    countryoptions: (state) => {
        return state.countryoptions
    },
    bloodtypeoptions: (state) => {
        return state.bloodtypeoptions
    },
    civilstateoptions: (state) => {
        return state.civilstateoptions
    },
    jobstateoptions: (state) => {
        return state.jobstateoptions
    }
}

export default {
    state,
    mutations,
    actions,
    getters
}