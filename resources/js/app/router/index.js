import { createRouter, createWebHashHistory } from 'vue-router'
import store from '../store';

const routes = [
    {
        path: '/',
        name: 'Login',
        component: () => import('../views/Login.vue'),
        meta: { requiresAuth: false, type: 3 }
    },
    {
        path: '/inicio',
        name: 'Inicio',
        component: () => import('../views/inicio.vue'),
        meta: { requiresAuth: true, type: 2 }
    },
    {
        path: '/asociados',
        name: 'Asociados',
        component: () => import('../views/Asociados.vue'),
        meta: { requiresAuth: true, type: 1 }
    },
    {
        path: '/administradores',
        name: 'Administradores',
        component: () => import('../views/Administradores.vue'),
        meta: { requiresAuth: true, type: 1 }
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
