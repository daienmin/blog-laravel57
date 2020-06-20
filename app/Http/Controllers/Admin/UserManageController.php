<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserManageController extends Controller
{
    /*
     * GET|HEAD
     * admin/user_manage
     * */
    public function index()
    {
        $users = AdminUser::paginate(10);
        return view('admin.user_manage.index', ['users' => $users]);
    }

    /*
     * POST
     * admin/user_manage
     * */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|max:30',
            'password' => 'required|min:6',
            're_password' => 'required|min:6|same:password',
            ],
            [
                'username.required' => '请输入用户名',
                'username.max' => '用户名长度不能超过30字符',
                'password.required' => '请输入密码',
                'password.min' => '密码不能小于6位',
                're_password.required' => '请输入确认密码',
                're_password.min' => '确认密码不能小于6位',
                're_password.same' => '确认密码必须和密码一致',
            ]
        );
        $data = $request->except(['_token', 's', 're_password']);
        if (AdminUser::where('username', $data['username'])->count() > 0) {
            return back()->withErrors(['用户名已存在']);
        }
        $user = new AdminUser;
        $user->username = $data['username'];
        $user->password = encrypt($data['password']);
        $user->role_id = $data['role_id'];
        $user->status = $data['status'];
        if ($user->save()) {
            return redirect('admin/user_manage');
        }
        return back()->withErrors(['添加用户失败，请稍后重试']);
    }

    /*
     * GET|HEAD
     * admin/user_manage/create
     * */
    public function create()
    {
        return view('admin.user_manage.add');
    }

    /*
     * GET|HEAD
     * admin/user_manage/{user_manage}
     * */
    public function show()
    {
    }

    /*
     * PUT|PATCH
     * admin/user_manage/{user_manage}
     * */
    public function update($id, Request $request)
    {
        $user = AdminUser::find($id);
        $password = $request->get('password', '');
        $status = $request->get('status');
        if ($password) {
            $user->password = encrypt($password);
        }
        $user->status = $status;
        if ($user->save()) {
            return redirect('admin/user_manage');
        }
        return back()->with('error', '更新失败');
    }

    /*
     * DELETE
     * admin/user_manage/{user_manage}
     * */
    public function destroy($id)
    {
        $user = AdminUser::find($id);
        $res = ['status' => 0, 'msg' => '删除失败！'];
        if ($user->delete()) {
            $res['status'] = 1;
            $res['msg'] = '删除成功！';
        }
        return response()->json($res);
    }

    /*
     * GET|HEAD
     * admin/user_manage/{user_manage}/edit
     * */
    public function edit($id)
    {
        $user = AdminUser::find($id);
//        dd($user);
        return view('admin.user_manage.edit', ['user' => $user]);
    }

}
