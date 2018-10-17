import VueRouter from 'vue-router'
import Store from './store/index'
import jwtToken from './helpers/jwt'

let routes = [
    {
        path: '/',
        name: 'home',
        component: (resolve)=>require(['./components/pages/Home'],resolve),
        meta: {}
    },
    {
        path: '/about',
        component: (resolve)=>require(['./components/pages/About'],resolve),
        meta: {}
    },
    {
        path: '/shops/:id',
        name: 'shops',
        component: (resolve)=>require(['./components/shops/Shop'],resolve),
        meta: {requiresAuth: true}
    },
    {
        path: '/register',
        name: 'register',
        component: (resolve)=>require(['./components/register/Register'],resolve),
        meta: {requiresGuest: true}
    },
    {
        path: '/login',
        name: 'login',
        component: (resolve)=>require(['./components/login/Login'],resolve),
        meta: {requiresGuest: true}
    },
    {
        path: '/profile',
        component: (resolve)=>require(['./components/user/ProfileWrapper'],resolve),
        children: [
            {
                path: '/confirm',
                name: 'confirm',
                component: (resolve)=>require(['./components/confirm/Email'],resolve),
                meta: {requiresGuest: true}
            },
            {
                path: '',
                name: 'profile',
                component: (resolve)=>require(['./components/user/Profile'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/edit-profile',
                name: 'profile.editProfile',
                component: (resolve)=>require(['./components/user/EditProfile'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/edit-password',
                name: 'profile.editPassword',
                component: (resolve)=>require(['./components/password/EditPassword'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/shop',
                name: 'profile.Shop',
                component: (resolve)=>require(['./components/shops/Shop'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/edit-shop',
                name: 'profile.editShop',
                component: (resolve)=>require(['./components/shops/EditShop'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/orders',
                name: 'profile.Orders',
                component: (resolve)=>require(['./components/orders/Orders'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/news',
                name: 'profile.News',
                component: (resolve)=>require(['./components/news/News'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/addnews',
                name: 'AddNews',
                component: (resolve)=>require(['./components/news/AddNews'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/dynamic',
                name: 'Dynamic',
                component: (resolve)=>require(['./components/news/Index'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/home',
                name: 'profile.Home',
                component: (resolve)=>require(['./components/home/Home'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/seed',
                name: 'profile.Seed',
                component: (resolve)=>require(['./components/seeds/Index'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/seed/:id',
                name: 'profile.editSeed',
                component: (resolve)=>require(['./components/seeds/Seed'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/seller',
                name: 'profile.Seller',
                component: (resolve)=>require(['./components/sellers/Index'],resolve),
                meta: {requiresAuth: true}
            },
            {
                path: '/buyer',
                name: 'profile.Buyer',
                component: (resolve)=>require(['./components/buyers/Index'],resolve),
                meta: {requiresAuth: true}
            },
        ],
        meta: {requiresAuth: true}
    }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth) {
    if (Store.state.AuthUser.authenticated || jwtToken.getToken()) {
        return next()
    } else {
        return next({'name': 'login'})
    }
}
if (to.meta.requiresGuest) {
    if (Store.state.AuthUser.authenticated || jwtToken.getToken()) {
        return next({'name': 'home'})
    } else {
        return next()
    }
}
next()
})

export default router
