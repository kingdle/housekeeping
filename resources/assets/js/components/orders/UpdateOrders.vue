<template>
    <div class="news-add">

    </div>
</template>
<script>
    import jwtToken from './../../helpers/jwt'
    import {ErrorBag} from 'vee-validate'

    export default {
        data() {
            return {
                addForm: {},
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
        methods: {
            addOrders() {
                const formData = {
                    name: this.addForm.userName,
                    phone: this.addForm.userPhone,
                    tags: this.selectTags,
                    count: this.addForm.seedCount,
                    sendDate: this.addForm.sendDate,
                    address: document.getElementById("maplocation").value,
                    state: this.addForm.orderState,
                    payment: this.addForm.orderPayment,
                }
                axios.post('/api/v1/orders', formData).then(response => {
                    this.orders = response.data.order.data
                    $('#AddOrdersModalCenter').modal('hide')
                })
//                this.$store.dispatch('addOrdersRequest', formData).then(response => {
//                    console.log(response.data.data)
//                    this.orders = response.data.order
//                this.orders.push(response.data.order)
////                    this.$router.push({name: 'profile.Orders',})
////                    this.addForm = {}
////                    this.selectTags = []
//                }).catch(error => {
//
//                })
            }
        }
    }
</script>
<style>
    .mg-news-img img:first-child {
        border-top-left-radius: 0.5rem !important;
    }

    .mg-news-img img:last-child {
        border-bottom-right-radius: 0.5rem !important;
    }

    .mg-upload-image .el-upload--picture-card {
        background-color: #fbfdff;
        border: 1px dashed #c0ccda;
        border-radius: 6px;
        box-sizing: border-box;
        width: 82px;
        height: 82px;
        line-height: 82px;
        vertical-align: top;
    }

    .mg-upload-image .el-upload-list--picture-card .el-upload-list__item {
        width: 82px;
        height: 82px;
    }

    .tags .el-select {
        display: block;
    }

    .el-date-table td.current:not(.disabled) span {
        color: #fff;
        background-color: #f06307;
    }

    .el-date-table td.today span {
        color: #f06307;
        font-weight: 700;
    }

    .el-radio__input.is-checked .el-radio__inner {
        border-color: #f06307;
        background: #f06307;
    }

    .el-radio__input.is-checked + .el-radio__label {
        color: #f06307;
    }

    .el-button--primary {
        color: #fff;
        background-color: #f06307;
        border-color: #f06307;
    }

    .tags .el-select {
        display: block;
    }

    .el-slider__bar {
        background-color: #f06307;
    }

    .el-slider__button {
        border: 2px solid #f06307;
        background-color: #fff;
    }

    .el-switch.is-checked .el-switch__core {
        border-color: #f06307;
        background-color: #f06307;
    }

    .el-range-editor.is-active, .el-range-editor.is-active:hover {
        border-color: #f06307;
    }

    .el-select .el-input.is-focus .el-input__inner {
        border-color: #f06307;
    }

    .el-input__inner:focus {
        border-color: #f06307;
        outline: 0;
    }

    .el-select-dropdown.is-multiple .el-select-dropdown__item.selected {
        color: #f06307;
        background-color: #fff;
    }

    .el-select-dropdown__item.selected {
        color: #f06307;
        font-weight: 700;
    }

    .el-date-table td.end-date span, .el-date-table td.start-date span {
        background-color: #f06307;
    }

    .el-switch__label.is-active {
        color: #f06307;
    }

    .el-button:focus, .el-button:hover {
        background: #28a745 !important;
        border-color: #28a745 !important;
        color: #fff;
    }
</style>
