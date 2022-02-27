import {
    createRouter, createWebHistory, NavigationGuardNext, RouteLocationNormalized,
    RouteLocationNormalizedLoaded, RouteLocationRaw, RouteRecordNormalized, RouteRecordRaw
} from "vue-router";
import {AUTH} from "../config";
import Index from "../components/views/Index";
import {Store} from "vuex";
import {StoreState} from "../store";
import {adminRoutes} from "./admin";


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
        name: 'profile',
        path: '/profile',
        component: () => import("../components/views/user/Profile"),
        meta: {
            access: AUTH.USER,
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
    {
        name: 'admin',
        path: '/admin',
        component: () => import("../components/views/admin/Admin"),
        children: adminRoutes,
        meta: {
            access: AUTH.ADMIN,
        },
    }
];

const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: 'active',
    strict: true,
    routes,
});

export const checkAccess = function (store: Store<StoreState>, route: RouteLocationNormalizedLoaded | RouteRecordNormalized): RouteLocationRaw | null {
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
        to.matched.forEach(route => {
            const accessedTo = checkAccess(store, route);
            if (accessedTo) {
                next(accessedTo);
                return;
            }
        })
        next();
    });
}

export default router;
