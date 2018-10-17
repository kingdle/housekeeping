<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">首页</div>
                <div v-for="shop in shops" :key="shop.id" class="card-body">
                    <h4>
                        <router-link :to="{name: 'shops', params: {id: shop.id}}">{{shop.title}}</router-link>
                    </h4>
                    <p>{{shop.summary}}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            axios.get('/api/v1/shops').then(response => {
                this.shops = response.data.data
        })
        },
        data(){
            return {
                shops: []
            }
        }
    }
</script>
