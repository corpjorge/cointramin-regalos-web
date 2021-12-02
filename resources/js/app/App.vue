<template>
    <template v-if="$store.state.Auth.auth">
        <template-auth/>
    </template>
    <template v-else>
        <TemplateGuess/>
    </template>
</template>

<script>


import TemplateAuth from "./Layout/TemplateAuth";
import TemplateGuess from "./Layout/TemplateGuess";
export default {
    components: {TemplateGuess, TemplateAuth}
}
</script>
