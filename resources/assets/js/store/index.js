import Vue from 'vue'
import Vuex from 'vuex'

import AuthUser from './modules/auth-user'
import AuthShop from './modules/auth-shop'
import AuthSeed from './modules/auth-seed'
import Login from './modules/login'
import EditProfile from './modules/edit-profile'
import EditPassword from './modules/edit-password'
import EditShop from './modules/edit-shop'

import EditOrder from './modules/edit-order'

import Notification from './modules/notification'

import AddNews from './modules/add-news'
import addDynamicRequest from './modules/add-dynamic'
import sendMessageRequest from './modules/send-message'

import AddOrders from './modules/add-orders'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        AuthUser,
        AuthShop,
        AuthSeed,
        Login,
        EditOrder,
        EditProfile,
        EditPassword,
        EditShop,
        Notification,
        AddNews,
        AddOrders,
        addDynamicRequest,
        sendMessageRequest
    },
    strict: true
})
