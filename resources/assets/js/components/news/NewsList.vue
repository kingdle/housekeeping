<template>
    <div class="card-columns pt-3">
        <div v-for="dynamic in dynamics" :key="dynamic.id" class="card card-img">
            <div class="mg-news-img">
                <img v-for="image in dynamic.pic" :src="image +'!mp.v300'" @click="handlePreview(image +'!mp.v1080')"
                     data-toggle="modal" data-target=".dynamic-image-lg">
            </div>
            <div class="p-2">
                <p class="card-text mt-2 mb-0">
                    <router-link :to="{ name: 'Dynamic', params: { id: dynamic.id }}" class="text-info">
                        {{ dynamic.content }}
                    </router-link>
                </p>
                <p class="card-text">
                    <small class="text-muted" v-for="sort in dynamic.sorts">
                        <svg id="i-menu" viewBox="0 0 32 32" width="10" height="10" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M4 8 L28 8 M4 16 L28 16 M4 24 L28 24" />
                        </svg>
                        {{sort.title}}
                    </small>
                    <small class="text-muted" v-for="tag in dynamic.tags">
                        <svg id="i-tag" viewBox="0 0 32 32" width="10" height="10" fill="none" stroke="currentcolor"
                             stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <circle cx="24" cy="8" r="2"/>
                            <path d="M2 18 L18 2 30 2 30 14 14 30 Z"/>
                        </svg>
                        {{tag.name}}
                    </small>
                    <small class="text-muted">
                        <svg id="i-clock" viewBox="0 0 32 32" width="10" height="10" fill="none"
                             stroke="currentcolor" stroke-linecap="round"
                             stroke-linejoin="round"
                             stroke-width="2">
                            <circle cx="16" cy="16" r="14"/>
                            <path d="M16 8 L16 16 20 20"/>
                        </svg>
                        {{ dynamic.published_at | moment("from") }}
                    </small>
                </p>
            </div>
        </div>
        <div class="modal fade dynamic-image-lg" tabindex="-1" role="dialog" aria-labelledby="dynamicLargeImageLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">图片预览</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img width="100%" :src="dialogImageUrl"
                             alt="" data-toggle="modal" data-target=".dynamic-image-lg">
                    </div>

                </div>
            </div>
        </div>



    </div>
</template>
<script>
    export default {
        props: ['dynamics'],
        data() {
            return {
                dialogImageUrl: '',

            }
        },
        methods: {
            handlePreview(image) {
                this.dialogImageUrl = image;
            }
        }
    }
</script>
<style>
    .mg-news-img {
        background: #f5f8fa;
    }

    .mg-news-img img {
        width: 90px;
        margin: 0 1px 1px 0;
    }

    .mg-news .card-img {
        border-top-left-radius: 0.5rem !important;
    }

    .mg-news-img img:first-child {
        border-top-left-radius: 0.5rem !important;
    }

    .mg-news-img img:last-child {
        border-bottom-right-radius: 0.5rem !important;
    }
</style>
