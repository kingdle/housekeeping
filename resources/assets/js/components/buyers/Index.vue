<template>
    <div class="mg-seed">
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-row mb-3 border-0">
                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="panel-heading">动态活跃度</div>
                                <div class="panel-body">
                                    <div v-for="post in posts" :key="post.id" class="bs-callout bs-callout-danger">
                                        <h4><router-link :to="{ name: 'posts', params: { id: post.id }}">{{ post.title }}</router-link></h4>
                                        <p>{{ post.body }}</p>
                                    </div>
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
    export default {
        mounted() {
            axios.get('/api/posts').then(response => {
                this.posts = response.data.data
            })
        },
        data() {
            return {
                posts : []
            }
        }
    }
</script>
