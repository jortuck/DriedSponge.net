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
                name: 'manage',
                component: () => import('../views/manage/views/Dashboard'),
                meta: {can: "Manage.See"}
            },
            {
                path: 'contact-form',
                name: 'contactform',
                component: () => import('../views/manage/views/Contact/Contactform'),
                children: [
                    {
                        path: '',
                        component: () => import('../views/manage/views/Contact/Responselist'),
                        meta: {can: "Contact.See"}
                    },
                ]
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
