<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Label;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /*
     * GET|HEAD
     * admin/article
     * */
    public function index()
    {
        $art = Article::paginate(10);
        return view('admin.article.index', ['art' => $art]);
    }

    /*
     * POST
     * admin/article
     * */
    public function store(Request $request)
    {
        dd($request->all());

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
        if (Article::where('username', $data['username'])->count() > 0) {
            return back()->withErrors(['用户名已存在']);
        }
        $user = new Article;
        $user->username = $data['username'];
        $user->password = encrypt($data['password']);
        $user->role_id = $data['role_id'];
        $user->status = $data['status'];
        if ($user->save()) {
            return redirect('admin/article');
        }
        return back()->withErrors(['添加用户失败，请稍后重试']);
    }

    /*
     * GET|HEAD
     * admin/article/create
     * */
    public function create(Category $category)
    {
        return view('admin.article.add', [
            'cate' => $category->getTreeCate(),
            'label' => (new Label())::select(['id', 'label_name'])->get(),
        ]);
    }

    /*
     * GET|HEAD
     * admin/article/{article}
     * */
    public function show()
    {
    }

    /*
     * PUT|PATCH
     * admin/article/{article}
     * */
    public function update($id, Request $request)
    {
        $user = Article::find($id);
        $password = $request->get('password', '');
        $status = $request->get('status');
        if ($password) {
            $user->password = encrypt($password);
        }
        $user->status = $status;
        if ($user->save()) {
            return redirect('admin/article');
        }
        return back()->with('error', '更新失败');
    }

    /*
     * DELETE
     * admin/article/{article}
     * */
    public function destroy($id)
    {
        $user = Article::find($id);
        $res = ['status' => 0, 'msg' => '删除失败！'];
        if ($user->delete()) {
            $res['status'] = 1;
            $res['msg'] = '删除成功！';
        }
        return response()->json($res);
    }

    /*
     * GET|HEAD
     * admin/article/{article}/edit
     * */
    public function edit($id)
    {
        $user = Article::find($id);
//        dd($user);
        return view('admin.article.edit', ['user' => $user]);
    }
}
