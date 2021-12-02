<template>
    <div class="container">
        <router-view />
    </div>
</template>

<script>
import Login from "../views/Login";
export default {
    name: "TemplateGuess",
    components: {Login}
}
</script>

<style scoped>

</style>
