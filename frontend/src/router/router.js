import {createRouter, createWebHistory} from "vue-router";
import UserPage from "@/pages/UserPage.vue";
import UsersPage from "@/pages/UsersPage.vue"
import LoginPage from "@/pages/LoginPage.vue";
import RegisterPage from "@/pages/RegisterPage.vue";

const routes = [
    {
        path: '/',
        component: UserPage
    },
    {
        path: '/users',
        component: UsersPage
    },
    {
        path: '/login',
        component: LoginPage
    },
    {
        path: '/register',
        component: RegisterPage
    }
]

const router = createRouter({
        routes,
        history: createWebHistory()
});

export default router;