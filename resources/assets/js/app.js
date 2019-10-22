import './bootstrap'
import Vue from 'vue'
import router from './router'
import store from './store'
import App from './components/App.vue'
import axios from 'axios'
import moment from 'moment';
//import BootstrapVue from 'bootstrap-vue'
//import 'bootstrap/dist/css/bootstrap.css'
//import 'bootstrap-vue/dist/bootstrap-vue.css'
import Vuelidate from 'vuelidate'

Vue.use(Vuelidate)
    //Vue.use(BootstrapVue)

Vue.filter('myDate', function(created) {
    return moment(created).format('DD/MM/YYYY')
});
const app = new Vue({
    router,
    store,
    el: '#app',
    render: h => h(App)
})