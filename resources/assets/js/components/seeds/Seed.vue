<template>
    <div class="mg-seed">
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-row mb-3 border-0">
                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="panel text-center set-up-icon">
                                    <ul class="list-group">
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">
                                                公司名:
                                            </p>
                                            <p class="set-up-item-content font-weight-bold text-dark">{{ seed.title
                                                }}</p>

                                        </li>
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">手机</p>
                                            <p class="set-up-item-content">{{ seed.phone }}</p>
                                            <button type="button" class="btn btn-success f-r" data-toggle="modal"
                                                    data-target="#SeedModalCenter">
                                                添加
                                            </button>
                                        </li>
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">备注:</p>
                                            <p class="set-up-item-content font-weight-bold text-dark">{{ seed.remark
                                                }}</p>
                                        </li>
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">地址：</p>
                                            <p class="set-up-item-content">{{ seed.address }}</p>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    export default {
        mounted() {
            axios.get('/api/v1/seeds/' + +this.$route.params.id).then(response => {
                this.seed = response.data.data
            })
        },
        data() {
            return {
                headers: {
                    Authorization: 'Bearer ' + window.localStorage.getItem('jwt_token')
                },
                seed: {},
            }
        },
        methods: {}
    }

</script>

