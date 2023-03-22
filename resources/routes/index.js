import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/users',
        name: 'users',
        component: () => import('../components/pages/users/users.vue'),
    },
    {
        path: '/posts',
        name: 'posts',
        component: () => import('../components/pages/publications/posts.vue'),
    },
    {
        path: '/posts/:idPost/detail',
        name: 'posts.detail',
        component: () => import('../components/pages/publications/postsDetail.vue'),
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
