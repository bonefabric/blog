<template>
    Application
    <router-link :to="{ name: 'index' }">Home</router-link>
    <router-link :to="{ name: 'about' }">About</router-link>
    <router-view/>
</template>

<script>
export default {
    name: "Application"
}
</script>

<style scoped>

</style>
