import axios from 'axios'
import store from './store'
import router from './router'

/**
 * Request
 */
axios.interceptors.request.use(
    (config) => {
        var token = localStorage.getItem('token')

        if (token) {
            config.headers['Authorization'] = 'Bearer ' + token
        }

        config.headers['X-Requested-With'] = 'XMLHttpRequest'
            // TODO: check if have any lang saved in localStorage, if not browser lang or default
        config.headers['Accept-Language'] = 'es'

        return config
    },
    (error) => {
        return Promise.reject(error)
    }
)

/**
 * Response
 */
axios.interceptors.response.use(
    (response) => {
        return response
    },
    (error) => {
        const originalRequest = error.config

        // token expired
        if (error.response.status === 401 && error.response.data.error == "token_expired") {
            originalRequest._retry = true

            store.dispatch('refreshToken').then((response) => {
                // console.log(response)
                let token = response.data.token
                let headerAuth = 'Bearer ' + response.data.token

                store.dispatch('saveToken', token)

                axios.defaults.headers['Authorization'] = headerAuth
                originalRequest.headers['Authorization'] = headerAuth

                return axios(originalRequest)
            }).catch((error) => {
                store.dispatch('logout').then(() => {
                    router.push({ name: 'login' })
                }).catch(() => {
                    router.push({ name: 'login' })
                })
            })
        }

        return Promise.reject(error)
    }
)