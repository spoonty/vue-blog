import {createRouter, createWebHistory} from "vue-router";
import UserPage from "@/pages/UserPage.vue";
import Users from "@/pages/Users.vue"

const routes = [
    {
        path: '/',
        component: UserPage
    },
    {
        path: '/users',
        component: Users
    }
]

const router = createRouter({
        routes,
        history: createWebHistory()
});

export default router;