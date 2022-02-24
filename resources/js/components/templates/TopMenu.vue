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
                <a href="version/old">(Go to old version)</a>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: "TopMenu"
}
</script>

<style scoped>

</style>
