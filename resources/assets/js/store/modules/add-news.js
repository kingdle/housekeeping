export default {
    actions: {
        // addNewsRequest({dispatch}, formData) {
        //     return axios.post('/api/v1/dynamics', formData).then(response => {
        //         // console.log(response.data)
        //         $('#AddNewsModalCenter').modal('hide')
        //         dispatch('showNotification', {level: 'success', msg: '动态发布成功'})
        //     }).catch(errors => {
        //         $('#AddNewsModalCenter').modal('hide')
        //         dispatch('showNotification', {level: 'error', msg: '动态发布失败'})
        //     })
        // },
        addNewsRequest({dispatch}, formData) {
            return axios.post('/api/v2/dynamic/create', formData).then(response => {
                console.log(response.data)
                $('#AddNewsModalCenter').modal('hide')
                dispatch('showNotification', {level: 'success', msg:  response.data.message})
            }).catch(errors => {
                $('#AddNewsModalCenter').modal('hide')
                dispatch('showNotification', {level: 'error', msg: response.data.message})
            })
        },
    }
}
