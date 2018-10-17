import * as types from './../mutation-type'
export default{
    state: {
        authenticated: false,
        id: null,
        user_id: null,
        title: null,
        property: null,
        content: null,
        phone: null,
        web_url: null,
        remark: null,
        is_active: null,
        address: null,
        published_at: null,
        code: null
    },
    mutations: {
        [types.UPDATE_SEED_PHONE](state, payload) {
            state.phone = payload.value
        },
        [types.SET_AUTH_SEED](state, payload) {
            state.authenticated = true,
            state.id = payload.seed.id
            state.user_id = payload.seed.user_id
            state.title = payload.seed.title
            state.property = payload.seed.property
            state.content = payload.seed.content
            state.phone = payload.seed.phone
            state.web_url = payload.seed.web_url
            state.remark = payload.seed.remark
            state.is_active = payload.seed.is_active
            state.address = payload.seed.address
            state.published_at = payload.seed.published_at
            state.code = payload.seed.code
        }
    },
    actions: {
        setAuthSeed({commit, dispatch}) {
            return axios.get('/api/v1/seeds/:id').then(response => {
                commit({
                    type: types.SET_AUTH_SEED,
                    seed: response.data
                })
            }).catch(error => {
            })
        }
    }
}
