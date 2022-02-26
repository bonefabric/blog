import {
    createRouter,
    createWebHistory, NavigationGuardNext,
    RouteLocationNormalized, RouteLocationRaw, RouteMeta,
    Router,
    RouteRecordRaw
} from "vue-router";
import {AUTH} from "../config";
import store from "../store";
import Index from "../components/views/Index";

const routes: RouteRecordRaw[] = [
    {
        name: 'index',
        path: '/',
        component: Index,
        meta: {
            access: AUTH.ALL,
        } as RouteMeta,
    } as RouteRecordRaw,
    {
        name: 'login',
        path: '/login',
        component: () => import("../components/views/Login"),
        meta: {
            access: AUTH.GUEST,
        } as RouteMeta,
    } as RouteRecordRaw,
    {
        name: 'register',
        path: '/register',
        component: () => import("../components/views/Register"),
        meta: {
            access: AUTH.GUEST,
        } as RouteMeta,
    } as RouteRecordRaw,
    {
        name: 'about',
        path: '/about',
        component: () => import("../components/views/About"),
        meta: {
            access: AUTH.ALL,
        } as RouteMeta,
    } as RouteRecordRaw,
];

const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: 'active',
    routes,
}) as Router;

export const checkAccess = function (route: RouteLocationNormalized) {
    if (!route.meta) {
        return null;
    }
    switch (route.meta.access) {
        case AUTH.ALL:
            return null;
        case AUTH.GUEST:
            if (store.state.profile.isAuthorized) {
                return {name: 'index'} as RouteLocationRaw;
            }
            return null;
        case AUTH.USER:
            if (!store.state.profile.isAuthorized) {
                return {name: 'login'} as RouteLocationRaw;
            } else if (store.state.profile.isAuthorized && store.state.profile.isBanned) {
                return {name: 'index'} as RouteLocationRaw;
            }
            return null;
        case AUTH.ADMIN:
            if (!store.state.profile.isAuthorized || !store.state.profile.isAdmin) {
                return {name: 'index'} as RouteLocationRaw;
            }
            return null;
        default:
            return {name: 'index'} as RouteLocationRaw;
    }
};

router.beforeEach((to: RouteLocationNormalized, from: RouteLocationNormalized, next: NavigationGuardNext): void => {
    const accessedTo = checkAccess(to);
    if (accessedTo) {
        next(accessedTo);
        return;
    }
    next();
});

export default router;
