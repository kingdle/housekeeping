export default {
    actions: {
        sendMessageRequest({dispatch}, formData) {
            return axios.post('api/v1/messages', formData).then(response => {
                console.log(response.data)
                dispatch('showNotification', {level: 'success', msg: response.data.messageContent})
            }).catch(errors => {
                dispatch('showNotification', {level: 'error', msg: '留言失败'})
            })
        },
    }
}
