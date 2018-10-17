<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>温馨大姐</title>


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #d1123a;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                padding:8%;
            }

            .title {
                font-size: 44px;
            }
            .body {
                font-size: 14px;
                color: #636b6f;
            }
            .body-conn{
                padding:0 8%;
            }
            .code img{
                width:220px;
                height:220px;
            }
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="code">
                    <image src="/images/mp-code.jpg"></image>
                </div>
                <div class="title">
                    温馨大姐
                </div>
                <div class="body m-b-md">
                    <div class="body-conn">
                        打开微信扫一扫<br>
                        贴心月嫂、保洁、养老护理、家务服务等
                    </div>
                </div>
                <div class="links">
                    <a href="http://www.qdbfg.com">青岛经济技术开发区（青岛市黄岛区）人力资源和社会保障协会<br>
                        青岛市黄岛区温馨港湾职业培训学校<br></a>
                    <a href="https://veg.kim">青岛苗果智能科技有限公司<br>联合主办</a>
                </div>
            </div>
        </div>
    </body>
</html>
