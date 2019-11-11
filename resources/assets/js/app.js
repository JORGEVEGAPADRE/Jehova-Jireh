import './bootstrap'
import Vue from 'vue'
import router from './router'
import store from './store'
import App from './components/App.vue'
import axios from 'axios'
import moment from 'moment'
import fontawesome from '@fortawesome/fontawesome-free'
import { ValidationProvider } from 'vee-validate'
Vue.component('ValidationProvider', ValidationProvider)
Vue.component(fontawesome)

Vue.filter('myDate', function(created) {
    return moment(created).format('DD/MM/YYYY')
});
const app = new Vue({
    router,
    store,
    el: '#app',
    render: h => h(App)
})