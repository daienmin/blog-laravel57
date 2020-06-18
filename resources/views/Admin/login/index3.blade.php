@extends('layouts.admin.login')

@section('style')
    <style>
        .lyear-wrapper {
            position: relative;
        }
        .lyear-login {
            display: flex !important;
            min-height: 100vh;
            align-items: center !important;
            justify-content: center !important;
        }
        .lyear-login:after{
            content: '';
            min-height: inherit;
            font-size: 0;
        }
        .login-center {
            background-color: rgba(255,255,255,.075);
            min-width: 29.25rem;
            padding: 2.14286em 3.57143em;
            border-radius: 3px;
            margin: 2.85714em;
        }
        .login-header {
            margin-bottom: 1.5rem !important;
        }
        .login-center .has-feedback.feedback-left .form-control {
            padding-left: 38px;
            padding-right: 12px;
            background-color: rgba(255,255,255,.075);
            border-color: rgba(255,255,255,.075)
        }
        .login-center .has-feedback.feedback-left .form-control-feedback {
            left: 0;
            right: auto;
            width: 38px;
            height: 38px;
            line-height: 38px;
            z-index: 4;
            color: #dcdcdc;
        }
        .login-center .has-feedback.feedback-left.row .form-control-feedback {
            left: 15px;
        }
        .login-center .form-control::-webkit-input-placeholder{
            color: rgba(255, 255, 255, .8);
        }
        .login-center .form-control:-moz-placeholder{
            color: rgba(255, 255, 255, .8);
        }
        .login-center .form-control::-moz-placeholder{
            color: rgba(255, 255, 255, .8);
        }
        .login-center .form-control:-ms-input-placeholder{
            color: rgba(255, 255, 255, .8);
        }
        .login-center .custom-control-label::before {
            background: rgba(0, 0, 0, 0.3);
            border-color: rgba(0, 0, 0, 0.1);
        }
        .login-center .lyear-checkbox span::before {
            border-color: rgba(255,255,255,.075)
        }
    </style>
@endsection

@section('content')
<body>
<div class="row lyear-wrapper" style="background-image: url({{ asset('images/login-bg-3.jpg') }}); background-size: cover;">
    <div class="lyear-login">
        <div class="login-center">
            <div class="login-header text-center">
                <a href="javascript:void(0);"> <img alt="light year admin" src="{{ asset('images/logo-sidebar.png') }}"> </a>
            </div>
            <form action="#!" method="post">
                <div class="form-group has-feedback feedback-left">
                    <input type="text" placeholder="请输入您的用户名" class="form-control" name="username" id="username" />
                    <span class="mdi mdi-account form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback feedback-left">
                    <input type="password" placeholder="请输入密码" class="form-control" id="password" name="password" />
                    <span class="mdi mdi-lock form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group has-feedback feedback-left row">
                    <div class="col-xs-7">
                        <input type="text" name="captcha" class="form-control" placeholder="验证码">
                        <span class="mdi mdi-check-all form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="col-xs-5">
                        <img src="{{ captcha_src('default') }}" class="pull-right" id="captcha" style="cursor: pointer;" onclick="this.src=this.src+'?d='+Math.random();" title="点击刷新" alt="captcha">
                    </div>
                </div>
                <div class="form-group">
                    <label class="lyear-checkbox checkbox-primary m-t-10 text-white">
                        <input type="checkbox"><span>5天内自动登录</span>
                    </label>
                </div>
                <div class="form-group">
                    <button class="btn btn-block btn-primary" type="button" onclick="location.href='index.html'">立即登录</button>
                </div>
            </form>
            <footer class="col-sm-12 text-center text-white">
                <p class="m-b-0">Copyright © 2020 <a href="http://lyear.itshubao.com">IT书包</a>. All right reserved</p>
            </footer>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">;</script>
@endsection