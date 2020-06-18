<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\AdminUser;
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
        // 登录
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
            $userInfo = AdminUser::where('username', $data['username'])->get()->toArray();
            if (empty($userInfo)) {
                return back()->with('msg', '用户不存在');
            }
            // 验证密码
            if (decrypt($userInfo[0]['password']) != $data['password']) {
                return back()->with('msg', '密码错误！');
            }
            session(['user' => $userInfo[0]]);
            return redirect('admin/index/index');
        }
        return view('admin.login.index1');
    }

    /*
     * 退出
     * */
    public function logout()
    {
        session(['user' => null]);
        return redirect('admin/login/index');
    }
}
