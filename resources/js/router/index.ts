import {
    createRouter, createWebHistory, NavigationGuardNext, RouteLocationNormalized,
    RouteLocationNormalizedLoaded, RouteLocationRaw, RouteRecordRaw
} from "vue-router";
import {AUTH} from "../config";
import Index from "../components/views/Index";
import {Store} from "vuex";
import {StoreState} from "../store";

const routes: RouteRecordRaw[] = [
    {
        name: 'index',
        path: '/',
        component: Index,
        meta: {
            access: AUTH.ALL,
        },
    },
    {
        name: 'login',
        path: '/login',
        component: () => import("../components/views/Login"),
        meta: {
            access: AUTH.GUEST,
        },
    },
    {
        name: 'register',
        path: '/register',
        component: () => import("../components/views/Register"),
        meta: {
            access: AUTH.GUEST,
        },
    },
    {
        name: 'about',
        path: '/about',
        component: () => import("../components/views/About"),
        meta: {
            access: AUTH.ALL,
        },
    },
];

const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: 'active',
    routes,
});

export const checkAccess = function (store: Store<StoreState>, route: RouteLocationNormalizedLoaded): RouteLocationRaw | null {
    if (!route.meta.access) {
        return null;
    }
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

export const initGuard = function (store: Store<StoreState>) {
    router.beforeEach((to: RouteLocationNormalized, from: RouteLocationNormalized, next: NavigationGuardNext): void => {
        const accessedTo = checkAccess(store, to);
        if (accessedTo) {
            next(accessedTo);
            return;
        }
        next();
    });
}

export default router;
