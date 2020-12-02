import {createRouter, createWebHistory} from 'vue-router'
import session from "../store/session";

const routes = [
    {
        path: '/',
        name: 'home',
        component: () => import('../views/Home')
    },
    {
        path: '/projects',
        name: 'projects',
        component: () => import('../views/Projects.vue')
    },
    {
        path: '/manage',
        component: () => import('../views/Projects.vue'),
        children: [
            {
                path: 'bar',
                component: () => import('../views/Home'),
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
