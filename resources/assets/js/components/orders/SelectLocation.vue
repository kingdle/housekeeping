<template>
    <div class="select-location">
        <div class="modal bd-example-modal-lg" id="SelectLocationModalCenter" tabindex="-1" role="dialog"
             aria-hidden="true">
            <div style="margin:5px;float:left">
                <input style="width:200px;padding:3px 4px;" type="text" id="place" />
                <p class="mt-2" style="color: #fff">输入地址，敲回车键定位</p>
            </div>
            <div id="MapContainer"></div>
        </div>
    </div>
</template>
<script>
    import {TMap} from './../../locale/TMap'
    export default {
        data() {
            return {}
        },
        mounted() {
            TMap('SJOBZ-NNBCJ-ZIDFT-K74JD-RVKE6-AEFXX').then(qq => {
                var citylocation, map, marker = null;
                var searchService, markers = [];
                var center = new qq.maps.LatLng(36.834156935615496, 118.96845817565918);
                map = new qq.maps.Map(document.getElementById('MapContainer'), {
                    /*
                     MapTypeId的显示类型
                     ROADMAP	该地图类型显示普通的街道地图。
                     SATELLITE	该地图类型显示卫星图像。
                     HYBRID	该地图类型显示卫星图像上的主要街道透明层。
                     */

                    //通过mapTypeId来设置卫星地图样式
                    mapTypeId: qq.maps.MapTypeId.HYBRID,
                    center: center,
                    zoom: 13,
                    maxZoom:16,
                });
                //获取城市列表接口设置中心点
//                citylocation = new qq.maps.CityService({
//                    complete: function (result) {
//                        map.setCenter(result.detail.latLng);
//                    }
//                });
                //调用searchLocalCity();方法    根据用户IP查询城市信息。
//                citylocation.searchLocalCity();

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
                            document.getElementById("maplocation").value = maplocation
                        },
                        error: function (err) {
                            alert("服务端错误，请刷新浏览器后重试")
                        }
                    });
                    $('#SelectLocationModalCenter').modal('hide')
                    qq.maps.event.addListener(map, 'click', function (e) {
                        marker.setMap(null);
                    });
                });
                var ap = new qq.maps.place.Autocomplete(document.getElementById('place'));
                //调用Poi检索类。用于进行本地检索、周边检索等服务。
                var searchService = new qq.maps.SearchService({
                    map : map
                });
                //添加监听事件
                qq.maps.event.addListener(ap, "confirm", function(res){
                    searchService.search(res.value);
                });

            });

        },
        components: {

        },
        methods: {

        }
    }
</script>
<style>
    #MapContainer {
        min-width: 600px;
        min-height: 767px;
    }
</style>
