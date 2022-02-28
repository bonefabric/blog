<template>
    <router-view v-if="!loading"/>
    <div id="main-preloader" v-else>
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
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
    await store.dispatch('init');
    initGuard(store);
    loading.value = false;
    const accessedRoute = checkAccess(store, route);
    if (accessedRoute) {
        await router.push(accessedRoute);
    }
});
</script>

<style lang="scss" scoped>
#main-preloader {
    z-index: 10000;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
}
</style>
