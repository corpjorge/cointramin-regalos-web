<template>
    <button @click="logout" class="btn btn-secondary btn-sm mr-2 d-none d-lg-inline text-gray-600 small"
            style="color: white!important;">Salir
    </button>
</template>

<script>
import httpClient from "../plugins/AxiosGlobal";

export default {
    name: "Logout",
    methods: {
        logout() {
            httpClient.post('/logout').then(() => {
                sessionStorage.clear();
                window.location.assign("/");
            })
        }
    }
}
</script>

<style scoped>

</style>
