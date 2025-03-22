import { createRouter, createWebHistory } from "vue-router";
import Login from '@/views/auth/login.vue'
import Register from '@/views/auth/register.vue'
import CreateNote from '@/views/notes/create.vue'
import EditNote from '@/views/notes/edit.vue'
import Profile from '@/views/auth/profile.vue'

import store from '@/store'


const routes = [
    {
        path: "/",
        component: () => import("@/views/Home.vue"),
        name:'home',
        meta:{requiresAuth:true}
    },
    {
        path: "/login",
        component: Login,
        name: 'login',
        meta:{guest:true}
    },
    {
        path: "/register",
        component: Register,
        name: 'register',
        meta:{guest: true}
    },
    {
        path: "/profile",
        component: Profile,
        name: 'profile',
        meta:{requiresAuth: true}
    },
    {
        path: '/notes/create',
        name: 'notes.create',
        component: CreateNote,
        meta:{requiresAuth:true}
    },
    {
        path:'/notes/:slug',
        name: 'notes.edit',
        component: EditNote,
        meta:{requiresAuth:true}
    },
    // Catch-all route for undefined routes
    {
        path: '/:pathMatch(.*)*', // This matches any undefined routes
        redirect: '/', // Redirect to the home page
    },
];

const router =  createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to ,from ,next)=>{

    let isAuthenticated = store.getters['auth/isAuthenticated']

    if (to.meta.requiresAuth && !isAuthenticated) {
        next({name:'login'})
    }else if (to.meta.guest && isAuthenticated) {
        next({name: 'home'})
    }else{
        next()
    }


    /* if (!store.getters['auth/getUser']) {
        try {
            await store.dispatch('auth/getUser')
        } catch (error) {

        }
    }
    const isAuthenticated = store.getters['auth/isAuthenticated']
    if (to.meta.requiresAuth && !isAuthenticated) {
        console.log("1");
        next({'name':'login'})
    }else if (to.meta.guest && isAuthenticated) {
        console.log("2");
            next({'name':'home'})
    }else{

        next()
    }
    console.log(store.getters['auth/getUser']); */
    //next()
})



export default router
