<template>
    <div class="news-add">
        <div class="modal bd-example-modal-lg" id="AddNewsModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="ShopModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AddNewsModalLongTitle">
                            <label for="dynamic" class="control-label">发动态</label>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="addNews">
                            <div class="form-group" :class="{'has-error' : errors.has('dynamic') }">
                                <label for="dynamic" class="col-form-label">文字:
                                    <span class="help-block mr-2"
                                          v-show="errors.has('dynamic')">{{errors.first('dynamic')}}</span>
                                </label>
                                <textarea
                                        v-model="dynamic"
                                        v-validate data-vv-rules="required" data-vv-as="动态文字"
                                        placeholder="请输入内容（最多输入1800个）"
                                        rows="3"
                                        :class="{'input': true, 'is-invalid': errors.has('dynamic') }"
                                        class="form-control" id="dynamic" name="dynamic" required></textarea>

                            </div>
                            <div class="form-group news-img">
                                <label for="dynamic" class="col-form-label">图片:（最多9张）</label>
                                <el-upload
                                        class="mg-upload-image"
                                        :action="uploadAction"
                                        list-type="picture-card"
                                        multiple
                                        :limit="9"
                                        :on-exceed="handleExceed"
                                        :on-success="handleSuccess"
                                        :headers="headers"
                                        :file-list="fileList">
                                    <i class="el-icon-plus"></i>
                                </el-upload>
                            </div>
                            <div class="form-group tags">
                                <label class="col-form-label">分类:（建议最多3个）
                                </label>
                                <el-select
                                        v-model="sorts"
                                        name="sorts"
                                        multiple
                                        filterable
                                        remote
                                        default-first-option
                                        placeholder="请选择标签">
                                    <el-option
                                            v-for="item in options2"
                                            :key="item.id"
                                            :label="item.name"
                                            :value="item.id">
                                    </el-option>
                                </el-select>
                            </div>
                            <div class="form-group tags">
                                <label class="col-form-label">标签:（建议最多6个）
                                </label>
                                <el-select
                                        v-model="tags"
                                        name="tags"
                                        multiple
                                        filterable
                                        remote
                                        allow-create
                                        default-first-option
                                        placeholder="请选择标签">
                                    <el-option
                                            v-for="item in options"
                                            :key="item.id"
                                            :label="item.name"
                                            :value="item.id">
                                    </el-option>
                                </el-select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">确定</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
    import jwtToken from './../../helpers/jwt'
    import {ErrorBag} from 'vee-validate';
    //    import * as types from './../../store/mutation-type'
    export default {
        data() {
            return {
                dynamic: '',
                dynamics: [],
                fileList: [],
                dialogImageUrl: '',
                dialogVisible: false,
                uploadAction: '/api/v2/dynamic/upfile',
                headers: {
                    Authorization: 'Bearer ' + window.localStorage.getItem('jwt_token')
                },
                imageUrl: [],
                options: [],
                tags: [],
                sorts: [],
                options2: []
            }
        },
        mounted() {
            axios.get('/api/v1/tags').then(response => {
                this.options = response.data
            })
            axios.get('/api/v1/sort/all').then(response => {
                this.options2 = response.data
            })
        },
        methods: {
            handleSuccess(response){
                this.filesUrl = response.photo
                this.imageUrl.push(this.filesUrl)
            },
            handleBefore(){
                return this.files.length === 9 ? false : true // 只让它上传一张
            },
            handleRemove(file, fileList) {
                console.log(file);
            },
            handlePreview(file) {
                this.dialogImageUrl = file.url;
                this.dialogVisible = true;
            },
            handleExceed(files, fileList) {
                this.$message.warning(`当前限制选择 9 个文件，本次选择了 ${files.length} 个文件，共选择了 ${files.length + fileList.length} 个文件`);
            },

            addNews() {

                const formData = {
                    dynamicContent: this.dynamic,
                    imageUrl: this.imageUrl,
                    tags: this.tags,
                    sorts: this.sorts,
                }
                this.$store.dispatch('addNewsRequest', formData).then(response => {
                    this.$router.push({name: 'profile.News'})
                    this.dynamic = ''
                    this.fileList = []
                    this.imageUrl = []
                    this.tags = []
                    this.sorts = []
                }).catch(error => {

                })
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
</style>
