import FilmIndex from './components/films/Index.vue';
import FilmCreate from './components/films/Create.vue';
import Register from './components/authentication/Register.vue';
import Login from './components/authentication/Login.vue';
import PageNotFound from './components/static-pages/404.vue';

import VueRouter from 'vue-router';

const routes = [
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'home',
        path: '/',
        redirect: '/films'
    },
    {
        name: 'films.index',
        path: '/films',
        component: FilmIndex
    },
    {
        name: 'films.create',
        path: '/films/create',
        component: FilmCreate,
        meta: {
            auth: true
        }
    },
    {
        name: 'films.edit',
        path: '/films/:slug/edit',
        component: FilmCreate,
        meta: {
            auth: true
        }
    },
    {
        name: '404',
        path: '/404',
        component: PageNotFound,
    },
    {
        path: '*',
        redirect: '/404',
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes,
});

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('token')
    if (to.matched.some(record => record.meta.auth) && !loggedIn) {
        next('/login')
        return
    }
    next()
});

export default router;