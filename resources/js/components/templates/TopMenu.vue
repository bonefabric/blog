<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'index' }">Blog</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'about' }">About</router-link>
                </li>
            </ul>
            <div>
                <a href="{{ 'version/old' }}}">(Go to old version)</a>
                <a href="#" @click.prevent="logout" class="ms-3">Logout</a>
            </div>
        </div>
    </nav>
</template>

<script setup lang="ts">
import {API_VERSION} from "../../config";
import {useStore} from "vuex";
import {key, StoreState} from "../../store";
import {useRouter} from "vue-router";

const logoutLink = 'api/' + API_VERSION + '/auth/logout';
const store = useStore<StoreState>(key);
const router = useRouter();

const logout = () => {
    store.dispatch('logout');
    router.push({name: 'login'});
}
</script>
