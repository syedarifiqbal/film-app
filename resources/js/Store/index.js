import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        auth: null,
        errors: undefined
    },

    mutations: {

        setUserData(state, userData) {
            state.auth = userData.user
            localStorage.setItem('token', userData.user.api_token)
        },

        clearUserData() {
            localStorage.removeItem('token')
            location.reload()
        },

        setErrors(state, errors) {
            state.errors = errors
        },

        clearErrors(state) {
            state.errors = undefined
        }
    },

    actions: {
        login({ commit }, credentials) {
            return new Promise((resolve, reject) => {
                axios.post('/api/login', credentials)
                    .then(({data}) => {
                        commit('setUserData', data)
                        commit('clearErrors')
                        resolve(data)
                    })
                    .catch((error) => {
                        commit('setErrors', error.response.data.errors)
                        reject(error.response.data.errors)
                    })
            })
        },

        register({ commit }, postData) {
            return new Promise((resolve, reject) => {
                axios.post('/api/register', postData)
                    .then(({data}) => {
                        commit('setUserData', data)
                        commit('clearErrors')
                        resolve(data)
                    })
                    .catch((error) => {
                        console.log(error);
                        if(error.response.data.errors){
                            commit('setErrors', error.response.data.errors)
                        }
                        reject(error.response.data.errors)
                    })
            })
        },

        logout({ commit }) {
            commit('clearUserData')
        }
    },
    getters: {
        isLogged: state => !!state.auth,
        errors: state => state.errors
    }
})


export default store;