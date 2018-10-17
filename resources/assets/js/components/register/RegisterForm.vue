<template>
    <form class="form-horizontal" @submit.prevent="register">

        <div class="form-group row" :class="{'has-error' : errors.has('phone') }">
            <label for="phone" class="col-md-4 col-form-label text-md-right">手机号</label>
            <div class="col-md-6">
                <input v-model="phone"
                       v-validate data-vv-rules="required|numeric|max:11|min:11" data-vv-as="手机号"
                       class="form-control"
                       :class="{'input': true, 'is-invalid': errors.has('phone') }"
                       id="phone" type="text" name="phone" value="" required autofocus>
                <span class="help-block" v-show="errors.has('phone')">{{errors.first('phone')}}</span>
            </div>
        </div>
        <div class="form-group row" :class="{'has-error' : errors.has('password') }">
            <label for="password"
                   class="col-md-4 col-form-label text-md-right">密码</label>
            <div class="col-md-6">
                <input v-validate data-vv-rules="required|min:6" data-vv-as="密码"
                       class="form-control"
                       :class="{'input': true, 'is-invalid': errors.has('password') }"
                       v-model="password" id="password" type="password" name="password" required>
                <span class="help-block" v-show="errors.has('password')">{{errors.first('password')}}</span>
            </div>
        </div>

        <div class="form-group row" :class="{'has-error' : errors.has('password_confirmation') }">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">确认密码</label>

            <div class="col-md-6">
                <input id="password-confirm"
                       v-validate data-vv-rules="required|min:6|confirmed:password" data-vv-as="确认密码"
                       class="form-control"
                       :class="{'input': true, 'is-invalid': errors.has('password_confirmation') }"
                       type="password" name="password_confirmation" required>
                <span class="help-block" v-show="errors.has('password_confirmation')">{{errors.first('password_confirmation')}}</span>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-lg btn-success btn-block">
                    注册
                </button>
            </div>
        </div>
    </form>
</template>

<script>
    export default{
        data(){
            return {
                phone: '',
                password: ''
            }
        },
        methods: {
            register(){
                let formData = {
                    phone: this.phone,
                    password: this.password
                }
                axios.post('/api/register', formData).then(response => {
                    this.$router.push({name: 'confirm'})

                })
            }
        }
    }
</script>
