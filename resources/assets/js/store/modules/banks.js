import axios from 'axios'

const state = {
    banks: [],
    accounts: []
}

const mutations = {
    GET_BANKS(state, banks) {
        state.banks = banks.reverse()
    },
    GET_ACCOUNTS(state, accounts) {
        state.accounts = accounts
    },

    ADD_BANK(state, bank) {
        state.banks.unshift(bank)
    },
    EDIT_BANK(state, bankToEdit) {

        state.banks = state.banks;
    },
    DELETE_BANK(state, bankToDelete) {
        state.banks = state.banks.filter(bank => bank.id != bankToDelete.id);
    },
    ADD_ACCOUNT(state, account) {
        state.accounts.unshift(account)
    },
    EDIT_ACCOUNT(state, accountToEdit) {
        state.accounts = state.account;
    },
    DELETE_ACCOUNT(state, accountToDelete) {
        state.accounts = state.accounts.filter(account => account.id != accountToDelete.id);
    }
}

const actions = {
    getBanks({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get('/api/banks')
                .then((response) => {
                    commit('GET_BANKS', response.data.data)
                    resolve()
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    },
    getAccounts({ commit }, payload) {
        console.log(payload);
        console.log(payload);
        console.log(payload);
        return new Promise((resolve, reject) => {
            axios.get('/api/banks/accounts/' + payload)
                .then((response) => {
                    commit('GET_ACCOUNTS', response.data.data)
                    resolve()
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    },
    addBank({ commit }, bank) {
        return new Promise((resolve, reject) => {
            commit('ADD_BANK', bank)
            resolve()
        }, error => console.log(error))
    },
    editBank({ commit }, bank) {
        return new Promise((resolve, reject) => {
            axios.put(`/api/banks/${bank.id}`, bank)
                .then((response) => {
                    commit('EDIT_BANK', bank)
                    resolve(response)
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    },
    deleteBank({ commit }, bank) {
        return new Promise((resolve, reject) => {
            axios.delete('/api/banks/' + bank.id)
                .then((response) => {
                    commit('DELETE_BANK', bank)
                    resolve(response)
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    },

    addAccount({ commit }, account) {
        return new Promise((resolve, reject) => {
            axios.post('/api/banks/accounts', account)
                .then((response) => {
                    commit('ADD_ACCOUNT', response.data)
                    resolve(response)
                })
                .catch((error) => {
                    console.log(error);
                });

        }, error => console.log(error))
    },
    editAccount({ commit }, account) {
        return new Promise((resolve, reject) => {
            axios.put(`/api/banks/accounts/${account.id}`, account)
                .then((response) => {
                    commit('EDIT_ACCOUNT', account)
                    resolve(response)
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    },
    deleteAccount({ commit }, account) {
        return new Promise((resolve, reject) => {
            axios.delete('/api/banks/accounts/' + account.id)
                .then((response) => {
                    commit('DELETE_ACCOUNT', account)
                    resolve(response)
                })
                .catch((error) => {
                    console.log(error);
                });
        }, error => console.log(error))
    }

}

const getters = {
    banks: (state) => {
        return state.banks
    },
    accounts: (state) => {
        return state.accounts
    },
}


export default {
    state,
    mutations,
    actions,
    getters
}