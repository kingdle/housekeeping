export default {
    actions: {
        addOrdersRequest({dispatch}, formData) {
            var myDate = new Date();
            return axios.post('/api/v1/orders', formData).then(response => {
                $('#AddOrdersModalCenter').modal('hide')
                dispatch('showNotification', {level: 'success', msg: '订单创建成功'+'-'+response.data.name+'-'+myDate.toLocaleTimeString()})
            }).catch(errors => {
                $('#AddOrdersModalCenter').modal('hide')
                dispatch('showNotification', {level: 'error', msg: '订单创建失败'+myDate.toLocaleTimeString()})
            })
        },
        editOrderRequest({dispatch}, formData){
            // return axios.get('/api/v1/orders/'+ +'/edit', formData).then(response => {
            //     dispatch('showNotification', {level: 'success', msg: response.data.msg+'-'+myDate.toLocaleTimeString()})
            // }).catch(errors => {
            //     dispatch('showNotification', {level: 'error', msg: '状态更新失败'+myDate.toLocaleTimeString()})
            // })
        },
        updateStateRequest({dispatch}, formData) {
            var myDate = new Date();
            return axios.post('/api/v1/orders/updateState', formData).then(response => {
                dispatch('showNotification', {level: 'success', msg: response.data.msg+'-'+myDate.toLocaleTimeString()})
            }).catch(errors => {
                dispatch('showNotification', {level: 'error', msg: '状态更新失败'+myDate.toLocaleTimeString()})
            })
        },
        updatePaymentRequest({dispatch}, formData) {
            var myDate = new Date();
            return axios.post('/api/v1/orders/updatePayment', formData).then(response => {
                dispatch('showNotification', {level: 'success', msg: response.data.msg+'-'+myDate.toLocaleTimeString()})
            }).catch(errors => {
                dispatch('showNotification', {level: 'error', msg: '状态更新失败'+myDate.toLocaleTimeString()})
            })
        },
    }
}
