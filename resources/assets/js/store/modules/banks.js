import axios from 'axios'

const state = {
    banks: [],
    accounts: []

}

const mutations = {

    GET_BANKS(state, banks) {
        state.banks = banks;
    },
    GET_PAGINATION(state, payload) {
        state.pagination = payload;
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
    getBanks({ commit }, page) {
        return new Promise((resolve, reject) => {
            var urlBanks = 'banks?page=' + page;
            // original axios.get('/api/banks')
            axios.get(urlBanks)
                .then((res) => {
                    commit('GET_BANKS', res.data.banks.data)
                    commit('GET_PAGINATION', res.data.pagination)
                    resolve()
                })
                .catch((error) => {
                    console.log(error);
                });

        }, error => console.log(error))
    },
    getAccounts({ commit }, payload) {
        return new Promise((resolve, reject) => {
            axios.get('/api/accounts/' + payload)
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
            resolve();
        }, error => console.log("Jorge Gabriel", error));

    },
    editBank({ commit }, bank) {
        return new Promise((resolve, reject) => {
            axios.put(`/api/banks/${bank.id}`, bank)
                .then((response) => {
                    commit('EDIT_BANK', bank)
                    resolve(response)
                })
                .catch((error) => {
                    reject(error.response.data);
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
                    reject(error.response.data);
                });
        }, error => console.log(error))
    },
    //this.form.post('/api/banks')
    addAccount({ commit }, account) {
        return new Promise((resolve, reject) => {
            axios.post('/api/accounts', account)
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
            axios.put(`/api/accounts/${account.id}`, account)
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
            axios.delete('/api/accounts/' + account.id)
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
    /* banks: (state) => {
         return state.banks
     }, */
    accounts: (state) => {
            return state.accounts
        }
        /*pagination: (state) => {
             return state.pagination
         } */
}

export default {
    state,
    mutations,
    actions,
    getters
}