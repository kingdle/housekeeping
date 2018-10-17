<template>
    <div>

    </div>
</template>

<script>
    import jwtToken from './../../helpers/jwt'
    import {ErrorBag} from 'vee-validate';
    import * as types from './../../store/mutation-type'
    export default {
        data() {
            return {
                editForm:{},
                selectTags: [],
                tags: [],
                max: '',
                orders:{}
            }
        },
        mounted() {
            axios.get('/api/v1/tags').then(response => {
                this.tags = response.data
            })
        },
        created() {
            this.$store.dispatch('setEditOrder');
        },
        computed: {
            editForm: {
                get() {
                    return this.$store.state.EditOrder.editForm;
                },
                set(value) {
                    this.$store.commit({
                        type: types.EDIT_ORDER_FORM,
                        value: value
                    })
                }
            },
        },
        methods: {
            updateOrder() {
                const formData = {

                }
                this.$store.dispatch('editOrderRequest', formData).then(response => {
                    this.$router.push({name: 'profile.Orders'})
                }).catch(error => {

                })
            }
        }
    }
</script>
