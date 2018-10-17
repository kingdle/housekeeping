<template>
    <form class="form-signin" @submit.prevent="login">
        <img class="mb-4" src="https://images.veg.kim/pc/housekeeping-code.png" alt="" width="180" height="160">
    </form>
</template>

<script>

    export default {
        data() {
            return {
                code: '',
            }
        },
        computed: {
            mismatchError() {
                return this.bag.has('password:auth') && !this.errors.has('password')
            }
        },
        methods: {
            login() {
                this.$validator.validateAll().then(result => {
                    if (result) {
                        let formData = {
                            phone: this.phone,
                            password: this.password
                        }
                        this.$store.dispatch('loginRequest', formData).then(response => {
                            this.$router.push({name: 'profile.Home'})
                        }).catch(error => {
                            if (error.response.status === 401) {
                                this.bag.add('password', '手机号不存在或密码错误', 'auth');
                            }
                            if (error.response.status === 402) {
                                this.bag.add('password', '商家用户,请通过微信搜索"苗果"小程序登录', 'auth');
                            }
                            if (error.response.status === 421) {
                                this.bag.add('password', '手机号或密码错误', 'auth');
                            }
                        })
                    }
                    //
                })
            }
        }
    }
</script>
