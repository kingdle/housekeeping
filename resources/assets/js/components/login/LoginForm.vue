<template>
    <form class="form-signin" @submit.prevent="login">
        <img class="mb-4" src="https://images.veg.kim/pc/housekeeping-code.png" alt="" width="180" height="160">
        <input v-model="phone"
               v-validate data-vv-rules="required|numeric" data-vv-as="手机号"
               placeholder="请输手机号"
               id="phone" type="phone" class="form-control" name="phone" value="" required>
        <label for="password" class="sr-only">密码</label>
        <input v-validate data-vv-rules="required|min:6" data-vv-as="密码"
               placeholder="请输入密码"
               v-model="password" id="password" type="password" class="form-control" name="password" required>
        <label>
            <span class="help-block" v-show="errors.has('phone')">{{errors.first('phone')}}</span>
            <span class="help-block" v-show="errors.has('password')">{{errors.first('password')}}</span>
            <span class="help-block" v-if="mismatchError">{{bag.first('password:auth')}}</span>
        </label>
        <button class="btn btn-lg btn-success btn-block">登录</button>
        <p class="my-2 text-muted">密码请通过微信[温馨大姐小程序]设置</p>
    </form>
</template>

<script>
    import jwtToken from './../../helpers/jwt'
    import {ErrorBag} from 'vee-validate';
    export default {
        data() {
            return {
                phone: '',
                password: '',
                bag: new ErrorBag()
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
                                this.bag.add('password', '商家用户,请通过微信搜索"温馨大姐"小程序登录', 'auth');
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
