<template>
    <div class="mg-shop">
        <edit-shop-form></edit-shop-form>
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-row mb-3 border-0">
                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="panel text-center set-up-icon">
                                    <my-upload field="img"
                                               @crop-success="cropSuccess"
                                               @crop-upload-success="cropUploadSuccess"
                                               @crop-upload-fail="cropUploadFail"
                                               v-model="show"
                                               :width="200"
                                               :height="200"
                                               url="/api/v1/shop/avatar"
                                               :params="params"
                                               :headers="headers"
                                               img-format="png"></my-upload>
                                    <a class="btn" @click="toggleShow">
                                        <img class="rounded border-bottom user-avatar" :src=imgDataUrl?imgDataUrl:shop.avatar >
                                        <p class="mc-image-uploader">
                                            店铺头像
                                        </p>
                                    </a>
                                </div>
                                <div class="panel panel-default">
                                    <ul class="list-group">
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">
                                                苗果昵称:
                                            </p>
                                            <p class="set-up-item-content font-weight-bold text-dark">{{ shop.title }}</p>

                                        </li>
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">介绍:</p>
                                            <p class="set-up-item-content font-weight-bold text-dark">{{ shop.summary }}</p>
                                            <button type="button" class="btn btn-success f-r" data-toggle="modal"
                                                    data-target="#ShopModalCenter">
                                                修改
                                            </button>
                                        </li>
                                        <!--<li class="b-b p-b-20 p-t-20">-->
                                            <!--<p class="set-up-item-label text-secondary">性质</p>-->
                                            <!--<p class="set-up-item-content">{{ shop.property }}</p>-->
                                        <!--</li>-->
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">照片数</p>
                                            <p class="set-up-item-content">{{mgCharts.albumsCount}}</p>
                                        </li>
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">动态数</p>
                                            <p class="set-up-item-content">{{mgCharts.dynamicsCount}}</p>
                                        </li>
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">地址：</p>
                                            <p class="set-up-item-content">{{ shop.address }} {{ shop.villageInfo }}</p>
                                        </li>
                                        <li class="b-b p-b-20 p-t-20">
                                            <p class="set-up-item-label text-secondary">您的苗果小程序码</p>
                                            <p class="set-up-item-content">
                                                <img class="m-3 mx-5" :src="shop.code" alt="苗果"
                                                     width="120"
                                                     height="120">
                                            </p>
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
    import EditShopForm from './EditShopForm.vue'
    import {mapState} from 'vuex'
    import 'babel-polyfill'; // es6 shim
    import myUpload from 'vue-image-crop-upload';
    export default {
        created(){
            this.$store.dispatch('setAuthShop')
        },
        computed: {
            ...mapState({
                shop: state => state.AuthShop
            })
        },
        data() {
            return{
                show: false,
                params: {
                    name: 'img'
                },
                headers: {
                    Authorization:'Bearer '+window.localStorage.getItem('jwt_token')
                },
                imgDataUrl:'',
                mgCharts:{"albumsCount":'',"dynamicsCount":'',"ordersCount":''},
            }
        },
        mounted() {
            axios.get('/api/v1/count').then(response => {
                this.mgCharts = response.data
            })
        },
        components: {
            'my-upload': myUpload,
            EditShopForm,
        },
        methods: {
            toggleShow() {
                this.show = !this.show;
            },
            cropSuccess(imgDataUrl, field){
                console.log('-------- crop success --------');
//                console.log(imgDataUrl)
                this.imgDataUrl = imgDataUrl
//                this.shop.avatar = imgDataUrl;
            },
            cropUploadSuccess(response, field){
                console.log('-------- upload success --------');
                console.log(response);
                console.log('field: ' + field);
                setTimeout(() => {
                   this.show = !this.show;
                }, 1000)

            },
            cropUploadFail(status, field){
                console.log('-------- upload fail --------');
                console.log(status);
                console.log('field: ' + field);
            }
        }
    }

</script>
<style>
    .vue-image-crop-upload .vicp-wrap {
         width: 90% !important;
         height: 70% !important;
        max-width:600px;
        max-height:300px;
         background-color: rgba(255, 255, 255, 0.8) !important;
    }
    .vicp-drop-area {
        border: 1px dashed #f06307 !important;
    }
    .vicp-operate a {
        color: #f06307 !important;
        font-weight: 700;

    }
</style>
