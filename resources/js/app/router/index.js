import { createRouter, createWebHashHistory } from 'vue-router'
import store from '../store';

const routes = [
    {
        path: '/',
        name: 'Login',
        component: () => import('../views/Login.vue'),
        meta: { requiresAuth: false, type: 5 }
    },
    {
        path: '/inicio',
        name: 'Inicio',
        component: () => import('../views/inicio.vue'),
        meta: { requiresAuth: true, type: 5 }
    },

]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
    scrollBehavior() {
        return { top: 0 }
    },
})

router.beforeEach((to) => {
    store.dispatch('Auth/getUser');
    const type = sessionStorage.getItem("type");

    if ( type > to.meta.type ) {
        router.push({name: 'Inicio'})
    }

})
export default router
