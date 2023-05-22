import { createRouter, createWebHistory } from 'vue-router';
import Login from '@/pages/Login.vue';
import Home from '@/pages/Home.vue';
import Users from '@/pages/Users.vue';
import Folders from '@/pages/Folder.vue';
import { useUserStore } from '@/stores/storeUser';

const routes = [
    { path: '/Login', name: 'Login', component: Login },
    { path: '/Home', name: 'Home', component: Home },
    { path: '/Users', name: 'Users', component: Users },
    { path: '/Folders/:id', name: 'Folders', component: Folders },
    { path: '/:pathMatch(.*)*', redirect: '/' }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    const auth = useUserStore();
    if (to.name !== 'Login' && !auth.user.token) {
        next('/Login');
    } else if (to.name === 'Login' && auth.user.token) {
        next('/Home');
    } else {
        if ((to.name === 'Users') && auth.user.role !== 'admin') {
            next('/Home');
        }
        next();
    }
});

export default router;