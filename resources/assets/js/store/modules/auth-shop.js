import * as types from './../mutation-type'
export default{
    state: {
        authenticated: false,
        id: null,
        user_id: null,
        title: null,
        summary: null,
        content: null,
        property: null,
        avatar: null,
        pic_count: null,
        dynamic_count: null,
        address: null,
        villageInfo: null,
        published_at: null,
        code: null
    },
    mutations: {
        [types.UPDATE_SHOP_SUMMARY](state, payload) {
            state.summary = payload.value
        },
        [types.UPDATE_SHOP_VILLAGEINFO](state, payload) {
            state.villageInfo = payload.value
        },
        [types.SET_AUTH_SHOP](state, payload) {
            state.authenticated = true,
            state.id = payload.shop.id
            state.user_id = payload.shop.user_id
            state.title = payload.shop.title
            state.summary = payload.shop.summary
            state.content = payload.shop.content
            state.property = payload.shop.property
            state.avatar = payload.shop.avatar
            state.pic_count = payload.shop.pic_count
            state.dynamic_count = payload.shop.dynamic_count
            state.address = payload.shop.address
            state.villageInfo = payload.shop.villageInfo
            state.published_at = payload.shop.published_at
            state.code = payload.shop.code
        }
    },
    actions: {
        setAuthShop({commit, dispatch}) {
            return axios.get('/api/shop').then(response => {
                commit({
                    type: types.SET_AUTH_SHOP,
                    shop: response.data
                })
            }).catch(error => {
            })
        }
    }
}
