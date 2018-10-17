export default {
    actions: {
        updateSeedRequest({dispatch}, formData) {
            return axios.post('/api/user/seed/'+seed.id+'/edit', formData).then(response => {
                $('#SeedModalCenter').modal('hide')
                dispatch('showNotification', {level: 'success', msg: '资料更新成功'})
            }).catch(errors => {
                $('#SeedModalCenter').modal('hide')
                dispatch('showNotification', {level: 'error', msg: '资料更新失败'})
            })
        },
    }
}
