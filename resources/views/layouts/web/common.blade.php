<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>首页_杨青个人博客 - 一个站在web前端设计之路的女技术员个人博客网站</title>
    <meta name="keywords" content="个人博客,杨青个人博客,个人博客模板,杨青" />
    <meta name="description" content="杨青个人博客，是一个站在web前端设计之路的女程序员个人网站，提供个人博客模板免费资源下载的个人原创网站。" />
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
            <li><a href="share.html">模板分享</a></li>
            <li><a href="list.html">学无止境</a></li>
            <li><a href="info.html">慢生活</a></li>
            <li><a href="shareinfo.html">模板内容页</a></li>
            <li><a href="{{ url('/about') }}">关于我</a></li>
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