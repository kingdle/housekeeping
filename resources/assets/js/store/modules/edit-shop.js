export default {
    actions: {
        updateShopRequest({dispatch}, formData) {
            return axios.post('/api/user/shop/update', formData).then(response => {
                $('#ShopModalCenter').modal('hide')
                dispatch('showNotification', {level: 'success', msg: '资料更新成功'})
            }).catch(errors => {
                $('#ShopModalCenter').modal('hide')
                dispatch('showNotification', {level: 'error', msg: '资料更新失败'})
            })
        },
    }
}
