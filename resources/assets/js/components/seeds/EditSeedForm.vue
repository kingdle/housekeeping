<template>
    <div class="modal" id="SeedModalCenter" tabindex="-1" role="dialog" aria-labelledby="SeedModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="seedModalLongTitle">
                        <label class="control-label">修改商户信息</label>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="updateSeed(newSeed)" data-parsley-validate="" novalidate="">
                        <div class="form-group row" :class="{'has-error' : errors.has('name') }">
                            <label for="title" class="col-3 col-lg-2 col-form-label text-right">公司名</label>
                            <div class="col-9 col-lg-10">
                                <input id="title" class="form-control"
                                       v-model="title"
                                       type="text" placeholder="公司名">
                            </div>
                        </div>
                        <div class="form-group row" :class="{'has-error' : errors.has('name') }">
                            <label for="username" class="col-3 col-lg-2 col-form-label text-right">联系人</label>
                            <div class="col-9 col-lg-10">
                                <input id="username" v-model="username" type="text" required="" placeholder="联系人" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row" :class="{'has-error' : errors.has('name') }">
                            <label for="phone" class="col-3 col-lg-2 col-form-label text-right">电话</label>
                            <div class="col-9 col-lg-10">
                                <input id="phone" v-model="phone" type="text" required="" parsley-type="url" placeholder="电话" class="form-control">
                            </div>
                        </div>
                        <div class="row pt-2 pt-sm-5 mt-1">
                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                <label class="be-checkbox custom-control custom-checkbox">
                                    苗果信息为您服务！
                                </label>
                                <span class="help-block" v-show="errors.has('phone')">{{errors.first('phone')}}</span>
                            </div>
                            <div class="col-sm-6 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-success">确定修改</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import jwtToken from './../../helpers/jwt'
    import {ErrorBag} from 'vee-validate';
    import * as types from './../../store/mutation-type'
    import {mapState} from 'vuex'
    export default {
        created() {
            this.$store.dispatch('setAuthSeed');
        },
        computed: {
            ...mapState({
                user: state => state.AuthSeed
            }),
            title: {
                get() {
                    return this.$store.state.AuthSeed.title;
                },
                set(value) {
                    this.$store.commit({
                        type: types.UPDATE_SEED_TITLE,
                        value: value
                    })
                }
            },
            username: {
                get() {
                    return this.$store.state.AuthSeed.username;
                },
                set(value) {
                    this.$store.commit({
                        type: types.UPDATE_SEED_USERNAME,
                        value: value
                    })
                }
            },
            phone: {
                get() {
                    return this.$store.state.AuthSeed.phone;
                },
                set(value) {
                    this.$store.commit({
                        type: types.UPDATE_SEED_PHONE,
                        value: value
                    })
                }
            },
        },
        methods: {
            updateSeed() {

            }
        }
    }
</script>
