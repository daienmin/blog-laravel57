<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="description" content="@yield('description')" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/front/base.css') }}" rel="stylesheet">
    <link href="{{ asset('css/front/index.css') }}" rel="stylesheet">
    <link href="{{ asset('css/front/m.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{ asset('js/front/modernizr.js') }}"></script>
    <![endif]-->
    <script src="{{ asset('js/front/page.js') }}"></script>
</head>
<body>
<header>
    <div id="mnav">
        <div class="logo"><a href="/">杨青个人博客</a></div>
        <h2 id="mnavh"><span class="navicon"></span></h2>
        <ul id="starlist">
            <li><a href="/">首页</a></li>
            @if(!$cate_list->isEmpty())
                @foreach($cate_list as $v)
                    <li><a href="{{ url('/category/' . $v->id) }}">{{ $v->cate_name }}</a></li>
                @endforeach
            @endif
            {{--<li><a href="{{ url('/about') }}">关于我</a></li>--}}
        </ul>
        <div class="clear"></div>
    </div>
    <script>
        window.onload = function ()
        {
            var oH2 = document.getElementById("mnavh");
            var oUl = document.getElementById("starlist");
            oH2.onclick = function ()
            {
                var style = oUl.style;
                style.display = style.display == "block" ? "none" : "block";
                oH2.className = style.display == "block" ? "open" : ""
            }
        }
    </script>
</header>
<div class="line46"></div>

@yield('content')

<footer>
    <p>Design by <a href="/">杨青个人博客</a> <a href="/">蜀ICP备11002373号-1</a></p>
</footer>
</body>
</html>