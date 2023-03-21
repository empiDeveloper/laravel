import { createRouter, createWebHistory } from 'vue-router';
import Users from '../components/pages/users.vue';
import Posts from '../components/pages/posts.vue';

const routes = [
    {
        path: '/users',
        name: 'users',
        component: Users
    },
    {
        path: '/posts',
        name: 'posts',
        component: Posts
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
