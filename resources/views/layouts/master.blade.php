<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>温馨大姐</title>
    <link rel="stylesheet" href="/css/app.css">
    <style media="screen" type="text/css">
        #appLoading {
            width: 100%;
            height: 100%;
            /*background: url("https://images.veg.kim/pc/index-background.jpg") no-repeat center center fixed;*/
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            min-height: 1200px;
        }
        #appLoading h7 {
            color: #f06307;
            margin: 30px 0;
        }
        .explain h2 {
            color: #4f5356;
        }
        .explain p {
            font-size: 18px;
            color: #4f5356;
        }
    </style>
</head>
<body>
<div id="appLoading">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid px-0">
            <div class="navbar-header">
                <a href="/" class="navbar-brand" exact>
                    <img src="https://images.veg.kim/pc/housekeeping-logo-pc.png" alt="温馨大姐" width="160" height="42">
                </a>
                {{--<span><img src="https://images.veg.kim/pc/Spinner-1s-200px.gif" alt="loading" width="42" height="42"></span>--}}
                {{--<span style="color:#8a8e91">服务加载中...</span>--}}
            </div>
        </div>
    </nav>
    <div class="col-12 w-100per m-b-100 overflow-auto">
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
    </div>

</div>
<div id="app">
    <app></app>
</div>
<script src="/js/app.js"></script>
<style>
    .navbar {
        background-color: #f8f8f8;
        border-bottom: 1px solid #f1f1f1;
    }
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
</style>
</body>
</html>
