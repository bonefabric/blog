<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-6 offset-3">
                <form @submit.prevent v-if="!loading" class="mb-3">
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
                <div v-else>
                    Loading...
                </div>
                <div v-for="error in errors" class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Login',
    data() {
        return {
            email: '',
            password: '',
            remember: false,
            loading: false,
            errors: []
        }
    },
    methods: {
        async login() {
            this.loading = true;
            this.$store.dispatch('login', {
                email: this.email,
                password: this.password,
                remember: this.remember,
            })
                .then(result => this.errors = result.errors)
                .finally(() => this.loading = false);
        }
    }
}
</script>
