import {createRouter, createWebHistory} from "vue-router";
import UserPage from "@/pages/UserPage.vue";
import UsersPage from "@/pages/UsersPage.vue"
import LoginPage from "@/pages/LoginPage.vue";
import RegisterPage from "@/pages/RegisterPage.vue";
import EditPage from "@/pages/EditPage.vue";

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
    },
    {
        path: '/users/:id',
        component: UserPage
    },
    {
        path: '/edit',
        component: EditPage
    }
]

const router = createRouter({
        routes,
        history: createWebHistory()
});

export default router;