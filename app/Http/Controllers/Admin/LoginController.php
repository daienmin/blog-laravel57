<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
     * 后台登录
     * */
    public function index(Request $request)
    {

        if ($request->isMethod('post')) {
            $validate = Validator::make(
                $request->all(),
                [
                    'username' => 'bail|required',
                    'password' => 'bail|required',
                    'captcha' => 'bail|required',
                ],
                [
                    'username.required' => '请填写用户名',
                    'password.required' => '请填写密码',
                    'captcha.required' => '请填写验证码',
                ]
            )->errors();
            $err = $validate->getMessages();
            if (!empty($err)) {
                $err = array_shift($err);
                return back()->with('msg', $err[0]);
            }
            $data = $request->all();
            // 验证验证码
            if (!captcha_check($data['captcha'])) {
                return back()->with('msg', '验证码错误！');
            }


        }
        return view('admin.login.index1');
    }

    /*
     * 退出
     * */
    public function logout()
    {
        return 'logout';
    }
}
