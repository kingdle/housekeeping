export default {
    actions: {
        addDynamicRequest({dispatch}, formData) {
            var myDate = new Date();
            return axios.post('api/v1/news/addnews', formData).then(response => {
                console.log(response.data)
                dispatch('showNotification', {level: 'success', msg: '动态发布成功'+myDate.toLocaleTimeString()})
            }).catch(errors => {
                dispatch('showNotification', {level: 'error', msg: '动态发布失败'+myDate.toLocaleTimeString()})
            })
        },
    }
}
