<template>
    <div>
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-row mb-3">
                    <div class="card-body mt-2">
                        <div class="title">
                            <span class="text-success text-bold m-r-5">|</span>
                            <span class="vertical-middle">运营概况</span>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-12 mg-home-top">
                                <div class="row text-center" style="white-space:nowrap;">
                                    <div class="col pt-2">
                                        <h5 class="card-title text-muted pt-2 mb-0" style="white-space:nowrap;">相片数</h5>
                                        <p class="card-text text-secondary" style="white-space:nowrap;">
                                            {{mgCharts.albumsCount}}</p>
                                    </div>
                                    <div class="col pt-2">
                                        <h5 class="card-title text-muted pt-2 mb-0" style="white-space:nowrap;">动态数</h5>
                                        <p class="card-text text-secondary" style="white-space:nowrap;">
                                            {{mgCharts.dynamicsCount}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-7">
                                <div class="text-center mt-3 px-2"
                                     style="border-right:1px solid #eaeaea;border-left:1px solid #eaeaea">
                                    <a href="#" class="btn btn-success " data-toggle="modal"
                                       data-target="#AddNewsModalCenter">发动态</a>
                                    <a href="#">
                                        <router-link :to="{name: 'profile.Orders'}" class="btn btn-success"
                                                     activeClass="active" exact>
                                            查订单
                                        </router-link>
                                    </a>
                                    <p class="mt-3 text-muted">经常发动态就是最好的营销。</p>
                                </div>
                            </div>

                            <div class="col-sm-4 col-5">
                                <div class="p-0 text-center" style="">
                                    <img class="text-algin"
                                         :src="yourshop.code" alt=""
                                         width="90"
                                         height="90">
                                    <p class="card-title text-muted">您的苗果小程序码</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-md-row mb-3">
                    <div class="card-body mt-2">
                        <div class="mg-business">
                            <div class="mb-3">
                                <span class="text-success text-bold m-r-5">|</span>
                                <span class="vertical-middle">活跃的苗厂</span>
                            </div>
                            <div class="col-12 text-center">
                                <div v-for="shop in shops" :key="shop.id" class="figure mr-4 text-center">
                                    <div class="contributor-pics">
                                        <a href="#">
                                            <img :src="shop.avatar+'!mp.v100'"
                                                 width="64px"
                                                 :alt="shop.title"
                                                 :title="shop.title">
                                        </a>
                                    </div>
                                    <h6 class="shop-title pt-2 mb-0" :title="shop.title">{{shop.title}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="row">-->
            <!--<div class="col-md-12 px-0">-->
                <!--<div class="card flex-md-row mb-3">-->
                    <!--<div class="card-body mt-2">-->
                        <!--<div class="mg-hello p-2">-->
                            <!--<h5>老乡，您好!</h5>-->
                            <!--<p class="mb-0 mt-3">-->
                                <!--习主席说过：要让居民望得见山、看得见水、记得住乡愁。-->
                            <!--</p>-->
                            <!--<hr class="my-2">-->
                            <!--<p>-->
                                <!--每个人都有一份乡愁！而我们终于有机会来到家乡，编织梦想。战略家马云说过"梦想一定要有，万一实现了呢"，还有一句关于农业的"只有农村富，中国才会富，只有乡村强，中国才会强，只有乡村振兴，中国才会振兴"。-->
                                <!--我们有一个梦想，就是要-->
                                <!--<mark class="alert-success alert-link font-weight-bold">-->
                                    <!--用科技创新农业，用智慧振兴中国，用智能改变世界。-->
                                <!--</mark>-->
                            <!--<p>在这个平台上您会得到所需的一切服务，只要您有创新的想法，我们就能在平台上为您实现。请多多帮助小<a-->
                                    <!--href="https://veg.kim" target="_blank"-->
                                    <!--class="alert-success alert-link">-->
                                <!--苗果-->
                            <!--</a>，我们会在您的呵护下生根发芽、茁壮成长，谢谢。-->
                            <!--</p>-->
                            <!--<p>-->
                                <!--欢迎使用专业的种苗交易平台，目前我们上线了微信小程序，请通过微信搜索"<a href="https://veg.kim" target="_blank"-->
                                                                      <!--class="alert-success alert-link">苗果</a>"，或者扫码找到我们。-->
                            <!--</p>-->
                            <!--</p>-->
                            <!--<p>-->
                                <!--~~好了，就从苗开始，-->
                            <!--</p>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-md-row mb-3">
                    <div class="card-body mt-2">
                        <form @submit.prevent="sendMessage">
                            <div class="input-group">
                            <textarea class="form-control bd-callout lead"
                                      v-model="messageContent" id="messageContent"
                                      rows="3"
                                      placeholder="创新驱动价值，欢迎提意见。好想法被采纳，会有报酬的"
                                      aria-label="With textarea"></textarea>
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="submit">提交<br>想法</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <img class="m-3 mx-5 flex-auto d-none d-md-block" src="/images-pc/mg-code-mp.jpg" alt="苗果"
                         width="110"
                         height="110">
                </div>
            </div>
        </div>
        <div class="panel text-center panel-default mb-5 px-0 mg-footer">
            <hr class="my-4">
            <a href="https://veg.kim" target="_blank">苗果小程序 https://veg.kim</a>
        </div>


    </div>
</template>

<script>
    import {mapState} from 'vuex'
    export default {
        created(){
            this.$store.dispatch('setAuthUser'),
                this.$store.dispatch('setAuthShop')
        },
        computed: {
            ...mapState({
                user: state => state.AuthUser,
                yourshop: state => state.AuthShop
            })
        },
        mounted() {
            axios.get('/api/v1/shops').then(response => {
                this.shops = response.data.data
            })
            axios.get('/api/v1/count').then(response => {
                this.mgCharts = response.data
            })
        },
        data() {
            return {
                shops: [],
                mgCharts: {"albumsCount": '', "dynamicsCount": '', "ordersCount": ''},
                messageContent: ''
            }
        },
        methods: {
            sendMessage(){
                let formData = {
                    messageContent: this.messageContent,
                }
                this.$store.dispatch('sendMessageRequest', formData).then(response => {
                    this.$router.push({name: 'profile.Home'})
                    this.messageContent = ''
                }).catch(error => {

                })
            }
        }
    }

</script>
<style>
    .shop-title{
        width: 80px;
        height: 28px;
        line-height: 28px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .contributor-pics img{
        -webkit-transition: 0.4s;
        -webkit-transition: -webkit-transform 0.4s ease-out;
        transition: transform 0.4s ease-out;
        -moz-transition: -moz-transform 0.4s ease-out;
    }
    .contributor-pics img:hover{
        transform: rotateZ(360deg);
        -webkit-transform: rotateZ(360deg);
        -moz-transform: rotateZ(360deg);
    }
</style>
