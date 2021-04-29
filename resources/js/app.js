require('./bootstrap');

import App from './components/AppComponent.vue'
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import router from './routes';
import store from './Store';

window.Vue = require('vue').default;

Vue.use(VueRouter);

Vue.use(VueAxios, axios.create({
    baseURL: '/api',
    headers: {
        Authorization: `Bearer ${window.localStorage.getItem('token')}`
    }
}));



const app = new Vue({
    el: '#app',
    router,
    render: h => h(App),
    store,
    async created() {
        const token = localStorage.getItem("token");

        if (token) {
            try {
                const { data } = await this.axios.get('/user');
                this.$store.commit("setUserData", data);
            } catch (error) {
                localStorage.removeItem('token')
            }
        }

        this.axios.interceptors.response.use(
            response => response,
            error => {
                if (error.response.status === 401) {
                    this.$store.dispatch('logout')
                }
                return Promise.reject(error)
            }
        )
    }
});
