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
            const accessedTo = this.$router.checkAccess(this.$route);
            if (accessedTo) {
                this.$router.push(accessedTo);
            }
        });
    }
})
</script>

<style scoped>

</style>
