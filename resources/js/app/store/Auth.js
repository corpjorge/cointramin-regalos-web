import httpClient from "../plugins/AxiosGlobal";

export default {
    namespaced: true,
    state: {
        user: { type: {}},
        auth: false,
        type: sessionStorage.getItem('type') || null,
        token: sessionStorage.getItem('token') || null,
    },
    mutations: {
        SET_USER(state, user) {
            state.user = user;
            state.auth = Boolean(user);
        },
    },
    actions: {
        getUser({commit } ) {
            httpClient.get('/user').then(res =>{
                commit('SET_USER', res.data);
                sessionStorage.setItem('type', res.data.type);
                sessionStorage.setItem('ref', res.data.ref);
                sessionStorage.setItem('user', res.data.name);
            }).catch(()=>{
                // console.clear()
                // localStorage.clear()
                commit('SET_USER', null);
            })
        }
    },
    getters: {
        loggedIn(state) {
            return state.token !== null
        },
    }
}
