<template>
    <router-view v-if="!loading"/>
    <span v-else>Loading...</span>
</template>

<script setup lang="ts">
import {onBeforeMount, ref} from "vue";
import {key, StoreState} from "../store";
import {useRoute} from "vue-router";
import {useStore} from "vuex";
import router, {checkAccess, initGuard} from "../router";

const loading = ref(true);
const route = useRoute();
const store = useStore<StoreState>(key);

onBeforeMount(async () => {
    initGuard(store);
    await store.dispatch('init');
    loading.value = false;
    const accessedRoute = checkAccess(store, route);
    if (accessedRoute) {
        await router.push(accessedRoute);
    }
});
</script>
