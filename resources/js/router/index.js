import {createRouter, createWebHistory} from "vue-router";
import Index from "../components/views";

const routes = [
    {
        name: 'index',
        path: '/',
        component: Index,
    },
    {
        name: 'login',
        path: '/login',
        component: () => import("../components/views/Login"),
    },
    {
        name: 'register',
        path: '/register',
        component: () => import("../components/views/Register"),
    },
    {
        name: 'about',
        path: '/about',
        component: () => import("../components/views/About"),
    },
];

const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: 'active',
    routes,
});

router.beforeEach((to, from, next) => {
    next();
})

export default router;
