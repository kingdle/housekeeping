<template>
    <div class="mg-news">
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-row mb-3 border-0">
                    <div class="card-body mt-2">
                        <div class="row my-3">
                            <div class="col-sm-6 col-7">
                                <div class="text-center mt-3 px-2"
                                     style="border-right:1px solid #eaeaea;">
                                    <a class="btn btn-success m-r-10 text-light" data-toggle="modal"
                                       data-target="#AddNewsModalCenter">发动态</a>
                                    <p class="mt-3 text-muted">在这留下美好的回忆。</p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-5">

                                <div class="p-0 text-center">
                                    <img class="text-algin"
                                         :src="yourshop.code" alt=""
                                         width="90"
                                         height="90">
                                    <p class="card-title text-muted">您的苗果小程序码</p>
                                </div>
                            </div>
                        </div>
                        <div class="row my-3 border-top">
                            <dynamics :dynamics="dynamics"></dynamics>
                        </div>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" aria-label="Previous"
                                       @click.prevent="changePage(pagination.current_page - 1)">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber"
                                    :class="[ page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#"
                                       @click.prevent="changePage(page)">{{ page }}</a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" aria-label="Next"
                                       @click.prevent="changePage(pagination.current_page + 1)">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    import Dynamics from './NewsList'
    export default {
        created(){
            this.$store.dispatch('setAuthShop')
        },
        computed: {
            ...mapState({
                yourshop: state => state.AuthShop
            }),
            isActived: function () {
                return this.pagination.current_page;
            },
            pagesNumber: function () {
                if (!this.pagination.to) {
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        components:{
            Dynamics
        },
        mounted() {
            axios.get('/api/v1/dynamics-lists').then(response => {
                this.dynamics = response.data.data
                this.pagination = response.data.meta
            })
        },
        data() {
            return{
                dynamics:[],
                pagination: {
                    total: 0,
                    per_page: 0,
                    from: 0,
                    to: 0,
                    current_page: 1
                },
                offset: 9,
            }
        },
        methods: {
            changePage: function (page) {
                this.pagination.current_page = page;
                axios.get('/api/v1/dynamics-lists?page='+page).then(response => {
                    this.dynamics = response.data.data
                })
            }
        },
    }

</script>
<style>
    .mg-news-img {
        background: #f5f8fa;
    }

    .mg-news-img img {
        width: 72px;
        margin: 0 1px 1px 0;
    }

    .mg-news .card-img {
        border-top-left-radius: 0.5rem !important;
    }
    .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: #f06307;
        border-color: #f06307;
    }
    .page-link {
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #f06307;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }
    .page-link:hover {
        color: #f06307;
        text-decoration: none;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }
</style>
