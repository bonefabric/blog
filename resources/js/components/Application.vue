<template>
    <router-view v-if="!loading"/>
    <span v-else>Loading...</span>
</template>

<script>
import {defineComponent} from "vue";

export default defineComponent({
    name: "Application",
    data() {
        return {
            loading: true,
        }
    },
    beforeMount() {
        this.$store.dispatch('init').finally(() => {
            this.loading = false;
            if (!this.$store.state.profile.isAuthorized) {
                this.$router.push({ name: 'login' });
            }
        });
    }
})
</script>

<style scoped>

</style>
