<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'admin.dashboard' }">Dashboard</router-link>
                </li>
            </ul>
            <div class="d-flex">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ '/version/old' }}">(Go to old
                            version)</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" :class="{active: $route.name === 'profile' }" href="#"
                           id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ store.state.profile.name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li v-if="store.state.profile.isAdmin">
                                <router-link class="dropdown-item" :to="{name: 'index'}">Back to site</router-link>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" @click.prevent="logout" href="#">Log out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup lang="ts">
import {useStore} from "vuex";
import {useRouter} from "vue-router";
import {API_VERSION} from "../../../../config";
import {key, StoreState} from "../../../../store";

const logoutLink = 'api/' + API_VERSION + '/auth/logout';
const store = useStore<StoreState>(key);
const router = useRouter();

const logout = () => {
    store.dispatch('logout');
    router.push({name: 'login'});
}
</script>
