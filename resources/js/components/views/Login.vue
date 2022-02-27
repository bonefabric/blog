<template>
    <TopMenu/>
    <div class="container">
        <div class="row mt-5">
            <div class="col-6 offset-3">
                <div v-if="loading" id="login-preloader">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <form @submit.prevent v-else class="mb-3">
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp"
                               name="email" v-model="email">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="inputPassword" name="password"
                               v-model="password">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberCheck" name="remember"
                               v-model="remember">
                        <label class="form-check-label" for="rememberCheck">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary" @click="login">Submit</button>
                    <span class="ms-2">Need account? Register&nbsp;
                    <router-link :to="{ name: 'register' }">here</router-link>
                    </span>
                </form>
                <div v-for="error in errors" class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {ref} from "vue";
import {store} from "../../store";
import router from "../../router";
import TopMenu from "../templates/TopMenu.vue";

const email = ref('');
const password = ref('');
const remember = ref(false);
const loading = ref(false);
const errors = ref([] as string[]);

const login = async () => {
    loading.value = true;
    errors.value = [];
    const result = await store.dispatch('login', {
        email: email.value,
        password: password.value,
        loading: loading.value,
    });
    if (store.state.profile.isAuthorized) {
        await router.push({name: 'index'});
    } else {
        errors.value = result.errors;
    }
    loading.value = false;
}
</script>

<style lang="scss" scoped>
#login-preloader {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
}
</style>
