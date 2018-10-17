<template>
    <div class="mg-orders">
        <!--<edit-order></edit-order>-->
        <div class="modal bd-example-modal-lg" id="AddOrdersModalCenter" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="AddOrdersModalLongTitle">
                            <label class="control-label">新建订单</label>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body tags">
                        <el-form ref="addForm" :model="addForm" label-width="80px" size="medium">
                            <el-form-item label="农户姓名">
                                <el-input v-model="addForm.userName" placeholder="农户通过苗果小程序发送来的订单，姓名为微信昵称"></el-input>
                            </el-form-item>
                            <el-form-item label="电话">
                                <el-input v-model="addForm.userPhone" placeholder="默认为农户注册微信时的手机号"></el-input>
                            </el-form-item>
                            <el-form-item label="苗子品种">
                                <el-select
                                        v-model="selectTags"
                                        name="selectTags"
                                        :readonly="true"
                                        filterable
                                        remote
                                        allow-create
                                        default-first-option
                                        placeholder="请选择或新建品种">
                                    <el-option
                                            v-for="tag in tags"
                                            :key="tag.id"
                                            :label="tag.name +'('+ tag.bio+')'"
                                            :value="tag.id">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                            <el-form-item label="数量(株)">
                                <el-slider
                                        v-model="addForm.seedCount"
                                        :max="80000"
                                        :step="100"
                                        show-input
                                        input-size="mini">
                                </el-slider>
                            </el-form-item>
                            <el-form-item label="单价(元)">
                                <el-input-number
                                        v-model="addForm.UnitPrice"
                                        size="mini"
                                        :precision="2"
                                        :step="0.1"
                                        :min="0">
                                </el-input-number>
                            </el-form-item>
                            <el-form-item label="送苗日期" size="mini">
                                <el-date-picker
                                        v-model="addForm.sendDate"
                                        type="daterange"
                                        start-placeholder="最晚播种日期"
                                        end-placeholder="送苗日期"
                                        format="yyyy 年 MM 月 dd 日"
                                        value-format="yyyy-MM-dd"
                                        align="left"
                                        :picker-options="pickerOptions2"
                                >
                                </el-date-picker>
                            </el-form-item>
                            <el-form-item label="是否送苗" size="mini" class="is-state">
                                <el-switch v-model="addForm.orderState"
                                           active-value="1"
                                           inactive-value="0"
                                           active-color="#B1AFAD"
                                           inactive-color="#87CC82"
                                           active-text="已送苗"
                                           inactive-text="未送苗"></el-switch>
                            </el-form-item>
                            <el-form-item label="是否付款" size="mini" class="is-payment">
                                <el-switch v-model="addForm.orderPayment"
                                           active-value="1"
                                           inactive-value="0"
                                           active-color="#B1AFAD"
                                           inactive-color="#f06307"
                                           active-text="已付款"
                                           inactive-text="未付款"></el-switch>
                            </el-form-item>
                            <el-form-item label="地址">
                                <el-input v-model="addForm.userAddress" placeholder="请填写完表单后再选择地址" id="maplocation"
                                          :readonly="true" data-toggle="modal"
                                          data-target="#SelectLocationModalCenter"></el-input>
                            </el-form-item>

                            <el-form-item>
                                <el-button type="primary" @click="addOrders">立即创建</el-button>
                                <el-button type="info" data-dismiss="modal">取消</el-button>
                            </el-form-item>
                        </el-form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal bd-example-modal-lg" id="editOrderModalCenter" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editOrderModalLongTitle">
                            <label class="control-label">
                                编辑订单
                            </label>

                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body tags">
                        <el-form ref="editForm" :model="editForm" label-width="80px" size="medium">
                            <el-form-item label="订单号">
                                <el-input v-model="editForm.id"
                                          placeholder="订单号不可修改"
                                          :disabled="true">
                                </el-input>
                            </el-form-item>
                            <el-form-item label="真实姓名">
                                <el-input v-model="editForm.name"
                                          placeholder="农户通过苗果小程序发送来的订单，姓名为微信昵称"></el-input>
                            </el-form-item>
                            <el-form-item label="电话">
                                <el-input v-model="editForm.phone"
                                          placeholder="默认为农户注册微信时的手机号"></el-input>
                            </el-form-item>
                            <el-form-item label="苗子品种">
                                <el-select
                                        v-model="editSelectTags"
                                        name="editSelectTags"
                                        :readonly="true"
                                        filterable
                                        remote
                                        allow-create
                                        default-first-option
                                        placeholder="请选择或新建品种">
                                    <el-option
                                            v-for="tag in tags"
                                            :key="tag.id"
                                            :label="tag.name +'('+ tag.bio+')'"
                                            :value="tag.id">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                            <el-form-item label="数量(株)">
                                <el-input-number
                                        v-model="editForm.counts"
                                        :max="80000"
                                        :step="100"
                                        label="描述文字"
                                        size="mini">
                                </el-input-number>
                            </el-form-item>
                            <el-form-item label="单价(元)">
                                <el-input-number
                                        v-model="editForm.unit_price"
                                        size="mini"
                                        :precision="2"
                                        :step="0.1"
                                        :min="0">
                                </el-input-number>
                            </el-form-item>
                            <el-form-item label="送苗日期" size="mini">
                                <el-date-picker
                                        v-model="editSendDate"
                                        type="daterange"
                                        start-placeholder="最晚育苗日期"
                                        end-placeholder="送苗日期"
                                        format="yyyy 年 MM 月 dd 日"
                                        value-format="yyyy-MM-dd"
                                >
                                </el-date-picker>
                            </el-form-item>
                            <el-form-item label="是否送苗" size="mini" class="is-state">
                                <el-switch v-model="editForm.state"
                                           active-value="1"
                                           inactive-value="0"
                                           active-color="#B1AFAD"
                                           inactive-color="#87CC82"
                                           active-text="已送苗"
                                           inactive-text="未送苗"></el-switch>
                            </el-form-item>
                            <el-form-item label="是否付款" size="mini" class="is-payment">
                                <el-switch v-model="editForm.payment"
                                           active-value="1"
                                           inactive-value="0"
                                           active-color="#B1AFAD"
                                           inactive-color="#f06307"
                                           active-text="已付款"
                                           inactive-text="未付款"></el-switch>
                            </el-form-item>
                            <el-form-item label="地址">
                                <el-input v-model="EditAddress"
                                          placeholder="请填写完表单后再选择地址"
                                          id="editMapLocation"
                                          @click.native.prevent="setLocation()"
                                          :readonly="true" data-toggle="modal"
                                          data-target="#EditLocationModalCenter"></el-input>
                            </el-form-item>

                            <el-form-item>
                                <el-button type="primary" @click="updateOrder">确定更新</el-button>
                                <el-button type="info" data-dismiss="modal">取消</el-button>
                            </el-form-item>
                        </el-form>
                    </div>
                </div>
            </div>
        </div>
        <select-location></select-location>
        <edit-location></edit-location>
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-row mb-3">
                    <div class="card-body mt-2">
                        <div class="title">
                            <span class="text-success text-bold m-r-5">|</span>
                            <span class="vertical-middle">订单统计</span>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-12 mg-home-top">
                                <div class="row text-center" style="white-space:nowrap;">
                                    <div class="col pt-2">
                                        <h5 class="card-title text-muted pt-2 mb-0" style="white-space:nowrap;">订单数</h5>
                                        <p class="card-text text-secondary" style="white-space:nowrap;">
                                            {{OrderCharts.ordersCount}}
                                        </p>
                                    </div>
                                    <div class="col pt-2">
                                        <h5 class="card-title text-muted pt-2 mb-0" style="white-space:nowrap;">苗子数</h5>
                                        <p class="card-text text-secondary" style="white-space:nowrap;">
                                            {{OrderCharts.seedCount}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-7">
                                <div class="text-center mt-3 px-2"
                                     style="border-right:1px solid #eaeaea;border-left:1px solid #eaeaea">
                                    <a href="#" class="btn btn-success " data-toggle="modal"
                                       data-target="#AddOrdersModalCenter">新建订单</a>
                                    <p class="mt-3 text-muted">订单会自动提醒。</p>
                                </div>
                            </div>

                            <div class="col-sm-4 col-5">
                                <div class="p-0 text-center" style="">
                                    <!--<img class="text-algin"-->
                                    <!--:src="yourshop.code" alt=""-->
                                    <!--width="90"-->
                                    <!--height="90">-->
                                    <!--<p class="card-title text-muted">您的苗果小程序码</p>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="card flex-row mb-3 border-0">
                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="header-text-container">
                                    <div class="mb-3">
                                        <el-row>
                                            <el-col :span="2">
                                                <p class="vertical-middle">
                                                    <span class="text-success text-bold m-r-5">|</span>
                                                    订单列表
                                                    <!--<mark>农户在访问"苗果"小程序时，会看到自己在您的苗场订购的苗子订单数量和品种。</mark>-->
                                                </p>

                                            </el-col>
                                            <el-col :span="22">
                                                <div class="block">
                                                    <el-autocomplete
                                                            v-model="stateName"
                                                            :fetch-suggestions="querySearchAsync"
                                                            placeholder="农户姓名查询"
                                                            @select="handleSelect"
                                                            size="small"
                                                            prefix-icon="el-icon-search"
                                                    ></el-autocomplete>
                                                    <el-select
                                                            v-model="statePhone"
                                                            name="statePhone"
                                                            :readonly="true"
                                                            filterable
                                                            remote
                                                            allow-create
                                                            default-first-option
                                                            placeholder="手机查询"
                                                            @change="queryPhones"
                                                            size="small"
                                                            icon="el-icon-document">
                                                        <el-option
                                                                v-for="phones in queryPhone"
                                                                :key="phones.phone"
                                                                :label="phones.phone"
                                                                :value="phones.phone"
                                                        >
                                                        </el-option>
                                                    </el-select>
                                                    <el-select
                                                            v-model="stateTag"
                                                            name="stateTag"
                                                            :readonly="true"
                                                            filterable
                                                            remote
                                                            allow-create
                                                            default-first-option
                                                            placeholder="苗子品种查询"
                                                            @change="queryTags"
                                                            size="small"
                                                            icon="el-icon-document">
                                                        <el-option
                                                                v-for="tag in tags"
                                                                :key="tag.id"
                                                                :label="tag.name +'('+ tag.bio+')'"
                                                                :value="tag.id"
                                                                >
                                                        </el-option>
                                                    </el-select>
                                                    <el-select
                                                            v-model="stateVillageInfo"
                                                            name="stateVillageInfo"
                                                            :readonly="true"
                                                            filterable
                                                            remote
                                                            allow-create
                                                            default-first-option
                                                            placeholder="地址查询"
                                                            @change="queryAddress"
                                                            size="small"
                                                            prefix-icon="el-icon-location-outline">
                                                        <el-option
                                                                v-for="address in queryVillageInfo"
                                                                :key="address.villageInfo"
                                                                :label="address.villageInfo"
                                                                :value="address.villageInfo"
                                                        >
                                                        </el-option>
                                                    </el-select>
                                                    <el-date-picker
                                                            v-model="stateStart"
                                                            type="date"
                                                            size="small"
                                                            placeholder="最晚播种日期"
                                                            @change="queryStartAt"
                                                            format="yyyy 年 MM 月 dd 日"
                                                            value-format="yyyy-MM-dd">
                                                    </el-date-picker>
                                                    <el-date-picker
                                                            v-model="stateEnd"
                                                            type="date"
                                                            size="small"
                                                            placeholder="送苗日期"
                                                            @change="queryEndAt"
                                                            format="yyyy 年 MM 月 dd 日"
                                                            value-format="yyyy-MM-dd">
                                                    </el-date-picker>
                                                </div>

                                            </el-col>
                                        </el-row>
                                    </div>
                                    <div class="body-container">
                                        <div class="my-3 border-top">
                                            <!--<orders :orders="orders"></orders>-->
                                            <el-table
                                                    :data="orders"
                                                    align="left"
                                                    style="width: 100%"
                                            >
                                                <el-table-column
                                                        prop="id"
                                                        label="序号"
                                                        sortable
                                                        width="80"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        prop="name"
                                                        label="姓名"
                                                        sortable
                                                        :formatter="nameFormat"
                                                        width="100"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        prop="phone"
                                                        label="电话"
                                                        sortable
                                                        width="110"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        prop="tags.name"
                                                        label="苗子品种"
                                                        sortable
                                                        width="110"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        prop="counts"
                                                        label="数量(株)"
                                                        sortable
                                                        width="100"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        prop="unit_price"
                                                        label="单价(元)"
                                                        width="80"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        prop='start_at'
                                                        label="育苗日期"
                                                        sortable
                                                        width="110"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        prop="end_at"
                                                        label="送苗日期"
                                                        sortable
                                                        width="110"
                                                >
                                                </el-table-column>
                                                <el-table-column
                                                        label="地址"
                                                        sortable
                                                >
                                                    <template slot-scope="scope">
                                                        <span style="margin-left: 3px">{{ scope.row.address }}，{{ scope.row.villageInfo }}</span>
                                                        <el-button type="text"
                                                                   class="checkLocation-button"
                                                                   icon="el-icon-location-outline"
                                                                   data-toggle="modal"
                                                                   data-target="#EditLocationModalCenter"
                                                                   @click.native.prevent="checkLocation(scope.$index, scope.row)">
                                                        </el-button>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column
                                                        prop="state"
                                                        label="送苗？"
                                                        width="80"
                                                        :filters="[{ text: '未送苗', value: '0' }, { text: '已送苗', value: '1' }]"
                                                        :filter-method="filterTag"
                                                        filter-placement="bottom-end">
                                                    <template slot-scope="scope">
                                                        <el-tooltip content="标记是否送苗" placement="top">
                                                            <el-switch
                                                                    v-model="scope.row.state"
                                                                    active-color="#B1AFAD"
                                                                    inactive-color="#87CC82"
                                                                    active-value="1"
                                                                    inactive-value="0"
                                                                    @click.native.prevent="updateState(scope.$index, scope.row)"
                                                            >
                                                            </el-switch>
                                                        </el-tooltip>
                                                    </template>
                                                </el-table-column>
                                                <el-table-column
                                                        prop="payment"
                                                        label="结账？"
                                                        width="80"
                                                        :filters="[{ text: '未付款', value: '0' }, { text: '已付款', value: '1' }]"
                                                        :filter-method="filterTag"
                                                        filter-placement="bottom-end">
                                                    <template slot-scope="scope">
                                                        <el-tooltip content="标记是否付款" placement="top">
                                                            <el-switch
                                                                    v-model="scope.row.payment"
                                                                    active-color="#B1AFAD"
                                                                    inactive-color="#f06307"
                                                                    active-value="1"
                                                                    inactive-value="0"
                                                                    @click.native.prevent="updatePayment(scope.$index, scope.row)"
                                                            >
                                                            </el-switch>
                                                        </el-tooltip>
                                                    </template>
                                                </el-table-column>

                                                <el-table-column
                                                        fixed="right"
                                                        label="操作"
                                                        width="120"
                                                >
                                                    <template slot-scope="scope">
                                                        <el-tooltip class="item" effect="dark" content="编辑"
                                                                    placement="left">
                                                            <el-button
                                                                    data-toggle="modal"
                                                                    data-target="#editOrderModalCenter"
                                                                    @click.native.prevent="handleEdit(scope.$index, scope.row)"
                                                                    type="primary" icon="el-icon-edit"
                                                                    size="mini">
                                                            </el-button>
                                                        </el-tooltip>
                                                        <el-tooltip class="item" effect="dark" content="删除"
                                                                    placement="top">
                                                            <el-button
                                                                    @click.native.prevent="handleDelete(scope.$index, scope.row)"
                                                                    type="info" icon="el-icon-delete"
                                                                    size="mini">
                                                            </el-button>
                                                        </el-tooltip>
                                                    </template>
                                                </el-table-column>
                                            </el-table>
                                        </div>
                                        <el-pagination
                                                @size-change="handleSizeChange"
                                                @current-change="handleCurrentChange"
                                                :current-page="currentPage"
                                                :page-sizes="[9, 20, 100, 300]"
                                                :page-size="9"
                                                :pager-count="pagerCount"
                                                layout="total, sizes, prev, pager, next, jumper"
                                                :total="pagination.total">
                                        </el-pagination>
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
    //    import Orders from './OrdersList'
    //    import EditOrder from './EditOrder'
    import SelectLocation from './SelectLocation'
    import EditLocation from './EditLocation'

    export default {
        data() {
            return {
                orders: [],
                pagination: {
                    total: 0,
                    per_page: 0,
                    from: 0,
                    to: 0,
                    current_page: 1
                },
                currentPage: 1,
                offset: 9,
                OrderCharts: {"ordersCount": '', "seedCount": ''},
                addForm: {UnitPrice: '1.00',},
                editForm: {},
                editSendDate: [],
                selectTags: [],
                editSelectTags: [],
                EditAddress: '',
                tags: [],
                max: '',
                selectQuery: '',
                queryOrder: '',
                selectClassify: '',
                pickerOptions2: {
                    shortcuts: [{
                        text: '三周后',
                        onClick(picker) {
                            const end = new Date();
                            const start = new Date();
                            end.setTime(start.getTime() + 3600 * 1000 * 24 * 21);
                            picker.$emit('pick', [start, end]);
                        }
                    }, {
                        text: '一个月后',
                        onClick(picker) {
                            const end = new Date();
                            const start = new Date();
                            end.setTime(start.getTime() + 3600 * 1000 * 24 * 30);
                            picker.$emit('pick', [start, end]);
                        }
                    }, {
                        text: '两个月后',
                        onClick(picker) {
                            const end = new Date();
                            const start = new Date();
                            end.setTime(start.getTime() + 3600 * 1000 * 24 * 60);
                            picker.$emit('pick', [start, end]);
                        }
                    }]
                },
                pagerCount: 5,
                queryName: [],
                stateName: '',
                queryPhone: [],
                statePhone: '',
                queryNickname: [],
                stateNickname: '',
                queryTag: [],
                stateTag: '',
                queryVillageInfo: [],
                stateVillageInfo: '',
                stateStart: '',
                stateEnd: '',
                timeout: null,

            }
        },
        computed: {
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
            },
        },
        watch: {
            editSendDate(value) {
                this.editSendDate = value;
            },
            EditAddress(value) {
                this.EditAddress = value;
            }
        },
        components: {
//            Orders,
//            AddOrder,
//            EditOrder,
            SelectLocation,
            EditLocation
        },
        mounted() {
            axios.get('/api/v1/orders-lists').then(response => {
                this.orders = response.data.data
                this.pagination = response.data.meta
                console.log(this.orders)
            })
            axios.get('/api/v1/countOrder').then(response => {
                this.OrderCharts = response.data
            })
            axios.get('/api/v1/tags').then(response => {
                this.tags = response.data
            })
            axios.get('/api/v1/orders-query-phone').then(response => {
                this.queryPhone = response.data
            })
            axios.get('/api/v1/orders-query-address').then(response => {
                this.queryVillageInfo = response.data
            })
            this.queryName = this.loadAll()
        },

        methods: {
            changePage: function (page) {
                this.pagination.current_page = page;
                axios.get('/api/v1/orders-lists?page=' + page).then(response => {
                    this.orders = response.data.data
                })
            },
            handleSizeChange(pageSize) {
                this.pagination.per_page = pageSize
                const formData = {
                    pagination: pageSize,
                }
                axios.post('/api/v1/orders-list-size', formData).then(response => {
                    this.orders = response.data.data
                })
            },
            handleCurrentChange(val) {
                this.pagination.current_page = val;
                const formData = {
                    pagination: this.pagination.per_page,
                }
                axios.post('/api/v1/orders-list-size?page=' + val,formData).then(response => {
                    this.orders = response.data.data
                })
            },
//            dateFormat: function (row, column) {
//                var date = row[column.property];
//                if (date == undefined) {
//                    return "";
//                }
//                return date.substring(0, 10);
//            },
            switchFormat: function (row, column) {
                var switchs = row[column.property];
                if (switchs === '0') {
                    return "未送苗";
                }
                return '已送苗';
            },
            nameFormat: function (row, column) {
                var nname = row[column.property];
                if (nname === '') {
                    if (row.nickname === null) {
                        return '';
                    }
                    return row.nickname + '(昵称)';
                }
                return nname;
            },
            addVillageInfoFormat: function (row, column) {
                if (row.address === null) {
                    return '未标注位置';
                }
                return row.address + '，' + row.villageInfo;
            },
            addOrders() {
                const formData = {
                    name: this.addForm.userName,
                    phone: this.addForm.userPhone,
                    tags: this.selectTags,
                    counts: this.addForm.seedCount,
                    unit_price: this.addForm.UnitPrice,
                    sendDate: this.addForm.sendDate,
                    address: document.getElementById("maplocation").value,
                    state: this.addForm.orderState,
                    payment: this.addForm.orderPayment,
                }
                console.log(this.currentPage)
                axios.post('/api/v1/orders', formData).then(response => {
//                    this.orders = response.data.order
                    this.currentPage = 1
                    axios.get('/api/v1/orders-lists?page' +this.currentPage).then(response => {
                        this.orders = response.data.data
                    })
                    $('#AddOrdersModalCenter').modal('hide')
                    axios.get('/api/v1/countOrder').then(response => {
                        this.OrderCharts = response.data
                    })
                })
                //这种方式也可以新增，发动态提醒
//                this.$store.dispatch('addOrdersRequest', formData).then(response => {
//                    this.orders = response.data.order.data
////                    this.$router.push({name: 'profile.Orders',})
////                    this.addForm = {}
////                    this.selectTags = []
//                }).catch(error => {
//
//                })
            },
            handleEdit(index, row) {
                this.editForm.id = row.id
                this.editForm.name = row.name
                this.editForm.phone = row.phone
                this.editSelectTags = (row.tags != null) ? row.tags.id : ''
                this.editForm.counts = row.counts
                this.editForm.unit_price = row.unit_price
                if(row.sendDate['0'] !== ''){
                    this.editSendDate = row.sendDate
                }
                this.editForm.state = row.state
                this.editForm.payment = row.payment
                this.EditAddress = (row.longitude != null) ? (row.address + ',' + row.villageInfo + ',' + row.cityInfo + ',' + row.longitude + ',' + row.latitude) : ''
            },
            checkLocation(index, row){
                if (row.longitude != '') {
                    var LatE = row.latitude
                    var LogE = row.longitude
                }
                if (row.longitude == '') {
                    LatE = 36.83360736034709
                    LogE = 118.9683723449707
                }
                var center = new qq.maps.LatLng(LatE, LogE)
                var myOptions = {
                    zoom: 16,
                    center: center,
                    mapTypeId: qq.maps.MapTypeId.HYBRID,
                    maxZoom: 16,
                }
                var map = new qq.maps.Map(document.getElementById("EditMapContainer"), myOptions);
                var anchor = new qq.maps.Point(20, 20),
                    size = new qq.maps.Size(32, 32),
                    origin = new qq.maps.Point(0, 0),
                    icond = new qq.maps.MarkerImage('images-pc/map-seedling-decolorization.png', size, origin, anchor);
                var marker = new qq.maps.Marker({
                    //设置Marker的位置坐标
                    position: center,
                    //设置显示Marker的地图
                    map: map,
                    icon: icond
                });
            },
            setLocation(){
                console.log(document.getElementById("editMapLocation").value)
                if (document.getElementById("editMapLocation").value != '') {
                    var editMapLocation = document.getElementById("editMapLocation").value;
                    var resultE = editMapLocation.split(",");
                    var LatE = resultE[4]
                    var LogE = resultE[3]
                }
                if (document.getElementById("editMapLocation").value == '') {
                    LatE = 36.83360736034709
                    LogE = 118.9683723449707
                }
                var center = new qq.maps.LatLng(LatE, LogE)
                var myOptions = {
                    zoom: 15,
                    center: center,
                    mapTypeId: qq.maps.MapTypeId.HYBRID,
                    maxZoom: 16,
                }
                var map = new qq.maps.Map(document.getElementById("EditMapContainer"), myOptions);
                var anchor = new qq.maps.Point(20, 20),
                    size = new qq.maps.Size(32, 32),
                    origin = new qq.maps.Point(0, 0),
                    icond = new qq.maps.MarkerImage('images-pc/map-seedling-decolorization.png', size, origin, anchor);
                var marker = new qq.maps.Marker({
                    //设置Marker的位置坐标
                    position: center,
                    //设置显示Marker的地图
                    map: map,
                    icon: icond
                });
                //绑定单击事件添加参数
                qq.maps.event.addListener(map, 'click', function (e) {
                    var lat = e.latLng.getLat().toFixed(5);
                    var lng = e.latLng.getLng().toFixed(5);
                    var anchor = new qq.maps.Point(20, 20),
                        size = new qq.maps.Size(32, 32),
                        origin = new qq.maps.Point(0, 0),
                        icon = new qq.maps.MarkerImage('images-pc/map-seedling.png', size, origin, anchor);
                    var marker = new qq.maps.Marker({
                        position: e.latLng,
                        map: map,
                        icon: icon,
                    });
                    var data = {
                        location: lat + ',' + lng,
                        key: "SJOBZ-NNBCJ-ZIDFT-K74JD-RVKE6-AEFXX", //key为自己向腾讯地图申请的密钥
                        get_poi: 0
                    };
                    var url = "https://apis.map.qq.com/ws/geocoder/v1/?";
                    data.output = "jsonp";
                    $.ajax({
                        type: "get",
                        dataType: 'jsonp',
                        data: data,
                        jsonp: "callback",
                        jsonpCallback: "QQmap",
                        url: url,
                        success: function (res) {
                            var add_info = res;
                            var maplocation = add_info.result.address + add_info.result.address_reference.town.title + ',' + add_info.result.address_reference.landmark_l2.title + add_info.result.address_reference.landmark_l2._dir_desc + ',' + add_info.result.address_component.city + ',' + lat + ',' + lng;
//                            var locations = maplocation.split(',');
                            document.getElementById("editMapLocation").value = maplocation
                        },
                        error: function (err) {
                            alert("服务端错误，请刷新浏览器后重试")
                        }
                    });
                    $('#EditLocationModalCenter').modal('hide')

                })
                var aps = new qq.maps.place.Autocomplete(document.getElementById('placeEdit'));
                //调用Poi检索类。用于进行本地检索、周边检索等服务。
                var searchService = new qq.maps.SearchService({
                    map: map
                });
                //添加监听事件
                qq.maps.event.addListener(aps, "confirm", function (res) {
                    searchService.search(res.value);
                });
            },
            updateOrder(){
                const formData = {
                    id: this.editForm.id,
                    name: this.editForm.name,
                    phone: this.editForm.phone,
                    tags: this.editSelectTags,
                    counts: this.editForm.counts,
                    unit_price: this.editForm.unit_price,
                    sendDate: this.editSendDate,
                    states: this.editForm.state,
                    payment: this.editForm.payment,
                    address: document.getElementById("editMapLocation").value,
                }
                axios.post('/api/v1/orders/updateOrder', formData).then(response => {
                    axios.get('/api/v1/orders-lists?page=' + this.pagination.current_page).then(response => {
                        this.orders = response.data.data
                    })
                    $('#editOrderModalCenter').modal('hide')
                    axios.get('/api/v1/countOrder').then(response => {
                        this.OrderCharts = response.data
                    })
                })
            },
            handleDelete(index, row) {
                axios.delete('/api/v1/orders/' + row.id).then(response => {
                    this.orders.splice(index, 1)
                    axios.get('/api/v1/countOrder').then(response => {
                        this.OrderCharts = response.data
                    })
                })
            },
            updatePayment(index, row) {
                const formData = {
                    payment: row.payment,
                    id: row.id,
                }
//                axios.post('/api/v1/orders/updateState' ,formData).then(response => {
//                    console.log(response.data)
//                })
                this.$store.dispatch('updatePaymentRequest', formData).then(response => {
                    this.orders = response.data
                }).catch(error => {

                })
            },
            updateState(index, row) {
                const formData = {
                    state: row.state,
                    id: row.id,
                }
                this.$store.dispatch('updateStateRequest', formData).then(response => {
                    this.orders = response.data
                }).catch(error => {

                })
            },
            filterTag(value, row) {
                return row.state === value;
            },
            loadAll() {
                return [
                    axios.post('/api/v1/orders-list-query').then(response => {
                        this.queryName = response.data
                    })
                ]
            },
            querySearchAsync(queryString, cb) {
                var queryName = this.queryName;
                var results = queryString ? queryName.filter(this.createStateFilter(queryString)) : queryName;

                clearTimeout(this.timeout);
                this.timeout = setTimeout(() => {
                    cb(results);
                }, 1000 * Math.random());
            },
            createStateFilter(queryString) {
                return (state) => {
                    return (state.value.toLowerCase().indexOf(queryString.toLowerCase()) === 0);
                };
            },
            handleSelect(item) {
                const formData = {
                    name: item.value,
                }
                axios.post('/api/v1/orders-list-result',formData).then(response => {
                    this.orders = response.data.data
                    this.pagination = response.data.meta
                })
            },
            queryTags(val) {
                console.log(val)
                const formData = {
                    tag_id: val,
                }
                axios.post('/api/v1/orders-list-result',formData).then(response => {
                    this.orders = response.data.data
                    this.pagination = response.data.meta
                })
            },
            queryPhones(val) {
                console.log(val)
                const formData = {
                    phone: val,
                }
                axios.post('/api/v1/orders-list-result',formData).then(response => {
                    this.orders = response.data.data
                    this.pagination = response.data.meta
                })
            },
            queryAddress(val) {
                console.log(val)
                const formData = {
                    villageInfo: val,
                }
                axios.post('/api/v1/orders-list-result',formData).then(response => {
                    this.orders = response.data.data
                    this.pagination = response.data.meta
                })
            },
            queryStartAt(val) {
                console.log(val)
                if(val == null){
                    axios.get('/api/v1/orders-lists').then(response => {
                        this.orders = response.data.data
                        this.pagination = response.data.meta
                    })
                }else{
                    const formData = {
                        start_at: val,
                    }
                    axios.post('/api/v1/orders-list-result',formData).then(response => {
                        this.orders = response.data.data
                        this.pagination = response.data.meta
                    })
                }
            },
            queryEndAt(val) {
                console.log(val)
                if(val == null){
                    axios.get('/api/v1/orders-lists').then(response => {
                        this.orders = response.data.data
                        this.pagination = response.data.meta
                    })
                }else{
                    const formData = {
                        end_at: val,
                    }
                    axios.post('/api/v1/orders-list-result',formData).then(response => {
                        this.orders = response.data.data
                        this.pagination = response.data.meta
                    })
                }
            },
        }
    }

</script>
<style>
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

    .el-table .warning-row {
        background: oldlace;
    }

    .el-table .success-row {
        background: #f0f9eb;
    }

    .mg-news-img {
        background: #f5f8fa;
    }

    .mg-news-img img {
        width: 80px;
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

    .bd-example-border-utils [class^=border] {
        display: inline-block;
        width: 18%;
        height: 5rem;
        margin: .25rem;
        background-color: #f5f5f5;
    }

    .el-button + .el-button {
        margin-left: 0px;
        margin-top: 3px;
    }

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

    .is-payment .el-switch__label.is-active {
        color: #f06307;
    }

    .is-state .el-switch__label.is-active {
        color: rgb(135, 204, 130);
    }

    .el-button:focus, .el-button:hover {
        background: #28a745 !important;
        border-color: #28a745 !important;
        color: #fff;
    }

    .checkLocation-button {
        padding: 2px !important;
    }

    .selectClassify .el-select .el-input {
        width: 130px;
    }

    .input-with-select .el-input-group__prepend {
        background-color: #fff;
    }
    .el-pager li.active {
        color: #f06307;
        cursor: default;
    }
    .el-pager li:hover {
        color: #f06307;
        cursor: default;
    }
    .el-pagination button:hover {
        color: #f06307;
    }
</style>
