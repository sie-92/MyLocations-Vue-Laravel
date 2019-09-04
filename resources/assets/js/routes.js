import Home from './components/Home.vue';
import Login from './components/auth/Login.vue';
import MarkersNew from './components/markers/New.vue';

export const routes = [
    {
        path: '/',
        component: Home,
        props: true,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/new',
        component: MarkersNew,
        props: true,
        meta: {
            requiresAuth: true
        }
    }
];