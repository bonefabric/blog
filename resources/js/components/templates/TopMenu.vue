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
            <div class="d-flex">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ 'version/old' }}">(Go to old
                            version)</a>
                    </li>
                    <li v-if="store.state.profile.isAuthorized" class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" :class="{active: $route.name === 'profile' }" href="#"
                           id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ store.state.profile.name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li v-if="store.state.profile.isAdmin">
                                <router-link class="dropdown-item" :to="{name: 'dashboard'}">Admin panel</router-link>
                            </li>
                            <li>
                                <router-link class="dropdown-item" :to="{name: 'profile'}">Profile</router-link>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" @click.prevent="logout" href="#">Log out</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown" v-else>
                        <a class="nav-link dropdown-toggle" id="navbarDropdown2" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                            <li>
                                <router-link class="dropdown-item" :to="{name: 'login'}">Log in</router-link>
                            </li>
                            <li>
                                <router-link class="dropdown-item" :to="{name: 'register'}">Register</router-link>
                            </li>
                        </ul>
                    </li>
                </ul>
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
