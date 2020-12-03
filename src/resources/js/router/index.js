import {createRouter, createWebHistory} from 'vue-router'
import session from "../store/session";

const routes = [
    {
        path: '/',
        component: () => import('../views/public/Public'),
        children: [
            {
                path: '',
                name: 'home',
                component: () => import('../views/public/views/Home')
            },
            {
                path: '/projects',
                name: 'projects',
                component: () => import('../views/public/views/Projects.vue')
            },
        ]
    },


    {
        path: '/manage',
        meta: { requiresAuth: true},
        component: () => import('../views/manage/Manage'),
        children: [
            {
                path: '',
                component: () => import('../views/manage/views/Dashboard'),
                meta: {requiresAuth: true}
            }
        ]
    },
    {
        path: '/:pathMatch(.*)*',
        component: () => import('../views/errors/404'),
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})
router.beforeEach((to, from) => {
    session.fetch();
})
export default router
