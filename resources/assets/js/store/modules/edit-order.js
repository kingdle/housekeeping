import * as types from './../mutation-type'
export default{
    state: {
        authenticated: false,
        id: null,
        user_id: null,
        to_user_id: null,
        prod_id: null,
        tag_id: null,
        counts: null,
        price: null,
        unit_price: null,
        total_price: null,
        name: null,
        nickname: null,
        address: null,
        cityInfo: null,
        villageInfo: null,
        longitude: null,
        latitude: null,
        phone: null,
        state: null,
        state_at: null,
        payment: null,
        payment_at: null,
        start_at: null,
        end_at: null,
        note_buy: null,
        rate_buyer: null,
        note_sell: null,
        rate_seller: null,
        is_del: null,
        deleted_at: null,
    },
    mutations: {
        [types.EDIT_ORDER_FORM](state, payload) {
            state.authenticated = true,
            state.id = payload.order.id
            state.user_id = payload.order.user_id
            state.to_user_id = payload.order.to_user_id
            state.prod_id = payload.order.prod_id
            state.tag_id = payload.order.tag_id
            state.counts = payload.order.counts
            state.price = payload.order.price
            state.unit_price = payload.order.unit_price
            state.total_price = payload.order.total_price
            state.name = payload.order.name
            state.nickname = payload.order.nickname
            state.address = payload.order.address
            state.cityInfo = payload.order.cityInfo
            state.villageInfo = payload.order.villageInfo
            state.longitude = payload.order.longitude
            state.latitude = payload.order.latitude
            state.phone = payload.order.phone
            state.state = payload.order.state
            state.state_at = payload.order.state_at
            state.payment = payload.order.payment
            state.payment_at = payload.order.payment_at
            state.start_at = payload.order.start_at
            state.end_at = payload.order.end_at
            state.note_buy = payload.order.note_buy
            state.rate_buyer = payload.order.rate_buyer
            state.note_sell = payload.order.note_sell
            state.rate_seller = payload.order.rate_seller
            state.is_del = payload.order.is_del
            state.deleted_at = payload.order.deleted_at
        }
    },
    actions: {
        setEditOrder({commit, dispatch}) {
            return axios.get('/api/v1/orders/:id').then(response => {
                commit({
                    type: types.EDIT_ORDER_FORM,
                    order: response.data.data
                })
            }).catch(error => {
            })
        }
    }
}
