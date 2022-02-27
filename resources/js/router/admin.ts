import {RouteRecordRaw} from "vue-router";

export const adminRoutes: RouteRecordRaw[] = [
    {
        name: 'dashboard',
        path: 'dashboard',
        component: () => import("../components/views/admin/Dashboard"),
    }
];
