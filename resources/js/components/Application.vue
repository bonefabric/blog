<template>
    <router-view/>
</template>

<script>
import {defineComponent} from "vue";
import {Profile} from "../api/Profile";

export default defineComponent({
    name: "Application",
    mounted() {
        Profile.authorize();
    }
})
</script>

<style scoped>

</style>
