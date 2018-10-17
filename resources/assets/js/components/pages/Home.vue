<template>
    <div class="home">
        <div class="row">
            <div class="col-12 w-100per m-b-100 overflow-auto">
                <div class="w-1200 py-5 m-auto">
                    <h2 class="header text-center">
                        真情为您服务</h2>
                    <p class="header-ad text-sm text-center letter-10  m-b-45">
                        贴心月嫂、保洁、养老护理、家务</p>
                    <div class="my-0">
                        <div class="fl flex-4 text-center">
                            <a class="inline-block m-auto shop" href="#"><img
                                    class="hoverImg" style="width:288px;"
                                    src="https://images.veg.kim/pc/housekeeping-code.png">
                            </a>
                            <h6 class="text-secondary pt-2 mb-0">微信扫这个码就能找到我们</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="link col-12 text-center">
                <a href="http://www.qdbfg.com">青岛经济技术开发区（青岛市黄岛区）人力资源和社会保障协会<br>
                    青岛市黄岛区温馨港湾职业培训学校<br></a>
                <a href="https://veg.kim">青岛苗果智能科技有限公司<br>联合主办</a><br>
                <b class="mt-5 mb-3 text-muted">服务热线：0532-86941508</b><br>
                <b class="mt-5 mb-3 text-muted">技术支持：18678417700(微信)</b>
                <p class="mt-5 mb-3 text-muted">© 2018-2022</p>
                <p class="mb-5 text-muted">备案号：鲁ICP备11028443号-1</p>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                shops: [],
                active: 0
            }
        },
        mounted() {
//            axios.get('/api/v1/shops').then(response => {
//                this.shops = response.data.data
//            })
        },
        methods: {
            showActive(index) {
                this.active = index;
            }
        }


    }
</script>

<style>
    .header{
        color: #d71342;
        font-size:45px;
    }
    .header-ad{
        color: #6a6866;
    }
    .link{
        padding: 0 10%;
    }
    .shop-title {
        width: 120px;
        height: 28px;
        line-height: 28px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .code-pics{
        width:96%;
        left:50%
    }
    .code-pics img {
        border-radius: 50%;
        box-shadow: 0 0 20px #e4e8eb !important;
    }

    .code-pics {
        /*float: right;*/
    }

    .code-pics ul {
        margin-left: 1px;
        padding-left: 0px !important;
    }

    .code-pics ul li {
        display: inline-block;
        margin: 20px 10px;
        width: 100px;
        height: 100px;
    }

    .code-pics ul li a {
        position: relative;
        display: inline-block;
        width: 100px;
        height: 100px;
    }

    .hide_tab {
        position: absolute;
        bottom: 0;
        z-index: 999;
        margin-left: -50px;
    }
</style>
