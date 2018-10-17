import jwtToken from './../../helpers/jwt'

export default {
    actions: {
        updatePasswordRequest({dispatch}, formData) {
            var myDate = new Date();
            return axios.post('/api/user/password/update', formData).then(response => {
                $('#PasswordModalCenter').modal('hide')
                jwtToken.removeToken()
                dispatch('showNotification', {level: 'success', msg: '更新密码成功'+myDate.toLocaleTimeString()})
            }).catch(errors => {
                $('#PasswordModalCenter').modal('hide')
                dispatch('showNotification', {level: 'error', msg: '更新密码失败'+myDate.toLocaleTimeString()})
            })
        },
    }
}
