<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>登录页面 - 光年(Light Year Admin)后台管理系统模板</title>
    <link rel="icon" href="favicon.ico" type="image/ico">
    <meta name="keywords" content="LightYear,光年,后台模板,后台管理系统,光年HTML模板">
    <meta name="description" content="LightYear是一个基于Bootstrap v3.3.7的后台管理系统的HTML模板。">
    <meta name="author" content="yinqi">
    <link href="{{ asset('css/admin/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/materialdesignicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/style.min.css') }}" rel="stylesheet">
    @yield('style')
</head>

    @yield('content')
    <script type="text/javascript" src="{{ asset('js/admin/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/bootstrap.min.js') }}"></script>
    @yield('script')
</body>
</html>