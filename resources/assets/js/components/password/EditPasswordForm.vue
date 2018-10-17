<template>
    <div class="modal" id="PasswordModalCenter" tabindex="-1" role="dialog" aria-labelledby="PasswordModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordModalLongTitle">
                        <label for="name" class="control-label">修改密码</label>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="updatePassword">
                        <div class="form-group row" :class="{'has-error' : errors.has('password') }">
                            <label for="password" class="col-md-3 col-form-label text-md-right">密码</label>
                            <div class="col-md-6">
                                <input v-model="password"
                                       v-validate data-vv-rules="required|min:6" data-vv-as="密码"
                                       class="form-control"
                                       :class="{'input': true, 'is-invalid': errors.has('password') }"
                                       id="password" type="password" name="password" required>
                                <span class="help-block"
                                      v-show="errors.has('password')">{{errors.first('password')}}</span>
                            </div>
                        </div>
                        <div class="form-group row" :class="{'has-error' : errors.has('password_confirmation') }">
                            <label for="password-confirm" class="col-md-3 col-form-label text-md-right">确认密码</label>
                            <div class="col-md-6">
                                <input id="password-confirm"
                                       v-validate data-vv-rules="required|min:6|confirmed:password" data-vv-as="确认密码"
                                       class="form-control"
                                       :class="{'input': true, 'is-invalid': errors.has('password_confirmation') }"
                                       type="password" name="password_confirmation" required>
                                <span class="help-block" v-show="errors.has('password_confirmation')">
                                    {{errors.first('password_confirmation')}}
                                </span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">更新密码</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                password: '',
                password_confirmation: ''
            }
        },
        methods: {
            updatePassword() {
                this.$validator.validateAll().then(result => {
                    if (result) {
                        let formData = {
                            password: this.password
                        }
                        this.$store.dispatch('updatePasswordRequest', formData).then(response => {
                            // this.$router.push({name: 'profile'})
                            console.log('Success!');
                        }).catch(error => {
                            //
                        })
                    }
                    //
                })
            }
        }
    }
</script>
