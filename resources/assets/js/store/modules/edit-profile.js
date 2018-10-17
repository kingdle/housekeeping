export default {
    actions: {
        updateProfileRequest({dispatch}, formData) {
            return axios.post('/api/user/profile/update', formData).then(response => {
                $('#ProfileModalCenter').modal('hide')
                dispatch('showNotification', {level: 'success', msg: '资料更新成功'})
            }).catch(errors => {
                $('#ProfileModalCenter').modal('hide')
                dispatch('showNotification', {level: 'error', msg: '资料更新失败'})
            })
        },
    }
}
