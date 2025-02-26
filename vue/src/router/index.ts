import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/guests/:token',
            component: () => import('@/views/GuestPage.vue'),
            props: true,
        },
        {
            path: '/:pathMatch(.*)*',
            component: () => import('@/views/NotFound.vue')
        }
    ]
})

export default router
