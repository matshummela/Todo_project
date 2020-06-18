<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('assets/js/jquery-3.0.0.min.js')}}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script>
        //背景颜色
        function turncolors(color1,color2) {
            /*alert(color);*/
            $.get(
                'color',
                {
                    "color1":color1,
                    "color2":color2
                },function () {
                    $("body").css("background-color","#"+color1);
                    $("body").css("color","#"+color2);
                    $("button").css("background-color","#"+color1);
                }
            )
        }

    </script>
    @yield("style")

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .color-bd img {
            width: 20px;
            height: 20px;
            margin-left: 10px;
            margin-bottom: 5px;
        }
        body{
            background-color: {{ session('color1') ?? 'white' }};
            color: {{ session('color2') ?? 'black' }};
        }
    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'ToDoList') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <span>选择背景颜色</span>
                    <a href="#" class="color-bd" onclick="turncolors('e8ebec','343a40')"  id="color_01"><img alt="图片出错" src="{{ asset('assets/images/color01.png') }}"></a>
                    <a href="#" class="color-bd" onclick="turncolors('343a40','3490dc')"  id="color_01"><img alt="图片出错" src="{{ asset('assets/images/color02.png') }}"></a>
                    <a href="#" class="color-bd" onclick="turncolors('9561e2','343a40')"  id="color_01"><img alt="图片出错" src="{{ asset('assets/images/color03.png') }}"></a>
                    <a href="#" class="color-bd" onclick="turncolors('f6993f','343a40')"  id="color_01"><img alt="图片出错" src="{{ asset('assets/images/color04.png') }}"></a>
                    <a href="#" class="color-bd" onclick="turncolors('e3342f','343a40')"  id="color_01"><img alt="图片出错" src="{{ asset('assets/images/color05.png') }}"></a>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('登录') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('注册') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('注销') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
