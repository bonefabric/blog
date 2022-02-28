<template>
    <TopMenu/>
    <div class="container mt-5">
        <p v-if="store.state.profile.isAdmin"><strong>You use administrator account.</strong></p>
        <p><strong>Name:&nbsp;</strong>{{ store.state.profile.name }}</p>
        <p><strong>Email:&nbsp;</strong>{{ store.state.profile.email }}</p>
    </div>
</template>

<script setup lang="ts">
import TopMenu from "../../templates/TopMenu.vue";
import {useStore} from "vuex";
import {key, StoreState} from "../../../store";

const store = useStore<StoreState>(key);
</script>
