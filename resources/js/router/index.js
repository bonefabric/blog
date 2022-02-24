import {createRouter, createWebHistory} from "vue-router";
import Index from "../components/views";

const routes = [
    {
        name: 'index',
        path: '/',
        component: Index,
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
