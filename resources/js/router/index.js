import {createRouter, createWebHistory} from "vue-router";
import Index from "../components/views";
import {AUTH} from "../config";
import store from "../store";

const routes = [
    {
        name: 'index',
        path: '/',
        component: Index,
        meta: {
            access: AUTH.ALL,
        }
    },
    {
        name: 'login',
        path: '/login',
        component: () => import("../components/views/Login"),
        meta: {
            access: AUTH.GUEST,
        }
    },
    {
        name: 'register',
        path: '/register',
        component: () => import("../components/views/Register"),
        meta: {
            access: AUTH.GUEST,
        }
    },
    {
        name: 'about',
        path: '/about',
        component: () => import("../components/views/About"),
        meta: {
            access: AUTH.ALL,
        }
    },
];

const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: 'active',
    routes,
});

router.beforeEach((to, from, next) => {
    const accessedTo = router.checkAccess(to);
    if (accessedTo) {
        next(accessedTo);
        return;
    }
    next();
});

router.checkAccess = function (route) {
    switch (route.meta.access) {
        case AUTH.ALL:
            return null;
        case AUTH.GUEST:
            if (store.state.profile.isAuthorized) {
                return {name: 'index'};
            }
            return null;
        case AUTH.USER:
            if (!store.state.profile.isAuthorized) {
                return {name: 'login'};
            } else if (store.state.profile.isAuthorized && store.state.profile.isBanned) {
                return {name: 'index'};
            }
            return null;
        case AUTH.ADMIN:
            if (!store.state.profile.isAuthorized || !store.state.profile.isAdmin) {
                return {name: 'index'};
            }
            return null;
        default:
            return {name: 'index'};
    }
};

export default router;
