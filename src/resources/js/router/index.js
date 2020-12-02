import {createRouter, createWebHashHistory} from 'vue-router'
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
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})
router.afterEach((to, from) => {
     session.fetch();
})
export default router
