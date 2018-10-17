<template>
    <div class="modal" id="ShopModalCenter" tabindex="-1" role="dialog" aria-labelledby="ShopModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shopModalLongTitle">
                        <label for="name" class="control-label">修改您的育苗厂简介</label>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="updateShop">
                        <div class="form-group" :class="{'has-error' : errors.has('name') }">
                            <textarea
                                    v-model="summary"
                                    v-validate data-vv-rules="required" data-vv-as="介绍"
                                    rows="5"
                                    class="form-control" id="summary" name="summary" required></textarea>
                            <span class="help-block" v-show="errors.has('summary')">{{errors.first('summary')}}</span>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">确定修改</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
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
    export default {
        created() {
            this.$store.dispatch('setAuthShop');
        },
        computed: {
            summary: {
                get() {
                    return this.$store.state.AuthShop.summary;
                },
                set(value) {
                    this.$store.commit({
                        type: types.UPDATE_SHOP_SUMMARY,
                        value: value
                    })
                }
            },
        },
        methods: {
            updateShop() {
                const formData = {
                    summary: this.summary,
                }
                this.$store.dispatch('updateShopRequest', formData).then(response => {
                    this.$router.push({name: 'profile.Shop'})
                }).catch(error => {

                })
            }
        }
    }
</script>
