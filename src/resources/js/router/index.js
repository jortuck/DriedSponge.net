import {createRouter, createWebHistory} from 'vue-router'
import session from "../store/session";

const routes = [
    {
        path: '/',
        component: () => import('../views/public/Public'),
        children: [
            {
                path: '',
                alias: ['/home'],
                name: 'home',
                component: () => import('../views/public/views/Home')
            },
            {
                path: '/projects',
                name: 'projects',
                component: () => import('../views/public/views/Projects.vue')
            },
            {
                path: '/login',
                name: 'login',
                component: () => import('../views/public/views/Login')
            },
            {
                path: 'mc',
                component: () => import('../views/public/views/MC/Mc'),
                children: [
                    {
                        path: '',
                        name: 'mc',
                        component: () => import('../views/public/views/MC/Serverlist'),
                    },
                    {
                        path: ':slug',
                        name: 'mc-server',
                        component: () => import('../views/public/views/MC/Server'),
                    },
                ]
            },
        ]
    },


    {
        path: '/manage',
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
                component: () => import('../views/manage/views/Contact/Contactform'),
                children: [
                    {
                        path: '',
                        name: 'contactform',
                        component: () => import('../views/manage/views/Contact/Responselist'),
                        meta: {can: "Contact.See"},
                    },
                ]
            },
            {
                path: 'alerts',
                component: () => import('../views/manage/views/Alerts/Alerts'),
                children: [
                    {
                        path: '',
                        name: 'alerts',
                        component: () => import('../views/manage/views/Alerts/Alertslist'),
                        meta: {can: "Alerts.See"},
                    },
                    {
                        path: 'create',
                        name: 'alerts-create',
                        component: () => import('../views/manage/views/Alerts/Create'),
                        meta: {can: "Alerts.Create"},
                    },
                    {
                        path: ':id/edit',
                        name: 'alerts-edit',
                        component: () => import('../views/manage/views/Alerts/Edit'),
                        meta: {can: "Alerts.Edit"},
                    },
                ]
            },
            {
                path: 'mc-servers',
                component: () => import('../views/manage/views/MC/Mc'),
                children: [
                    {
                        path: '',
                        name: 'mc-servers',
                        component: () => import('../views/manage/views/MC/Serverlist'),
                        meta: {can: "Projects.See"},
                    },
                    {
                        path: 'create',
                        name: 'mc-create',
                        component: () => import('../views/manage/views/MC/Create'),
                        meta: {can: "Projects.Create"},
                    },
                    {
                        path: ':id/edit',
                        name: 'mc-edit',
                        component: () => import('../views/manage/views/MC/Edit'),
                        meta: {can: "Projects.Edit"},
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
