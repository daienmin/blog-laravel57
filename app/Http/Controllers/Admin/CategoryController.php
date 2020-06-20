<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /*
     * GET|HEAD
     * admin/category
     * */
    public function index(Category $category)
    {
        return view('admin.category.index', ['res' => $category->getTreeCate()]);
    }

    /*
     * POST
     * admin/category
     * */
    public function store(Request $request)
    {
        $request->validate([
            'cate_name' => 'required|max:50',
        ],
            [
                'cate_name.required' => '请输入分类名',
                'username.max' => '分类名长度不能超过50字符',
            ]
        );
        $data = $request->except(['_token', 's']);

        $cate = new Category;
        $cate->cate_name = $data['cate_name'];
        $cate->pid = $data['pid'];
        $cate->keywords = $data['keywords'] ?: '';
        $cate->description = $data['description'] ?: '';
        $cate->status = $data['status'];
        $cate->sort = $data['sort'];
        if ($cate->save()) {
            return redirect('admin/category');
        }
        return back()->withErrors(['添加分类失败，请稍后重试']);
    }

    /*
     * GET|HEAD
     * admin/category/create
     * */
    public function create(Category $category)
    {
        return view('admin.category.add', ["res" => $category->getTreeCate()]);
    }

    /*
     * GET|HEAD
     * admin/category/{category}
     * */
    public function show()
    {
    }

    /*
     * PUT|PATCH
     * admin/category/{category}
     * */
    public function update($id, Request $request)
    {
        $cate = Category::find($id);
        $data = $request->all();
        $cate->pid = $data['pid'];
        $cate->cate_name = $data['cate_name'];
        $cate->keywords = $data['keywords'] ?: '';
        $cate->description = $data['description'] ?: '';
        $cate->sort = $data['sort'];
        $cate->status = $data['status'];
        if ($cate->save()) {
            return redirect('admin/category');
        }
        return back()->with('error', '更新失败');
    }

    /*
     * DELETE
     * admin/category/{category}
     * */
    public function destroy($id)
    {
        $res = ['status' => 0, 'msg' => '删除失败！'];
        $cate = Category::find($id);
        if (Category::where('pid', $cate->id)->count()) {
            $res['msg'] = '当前分类存在子分类，无法删除！';
            return response()->json($res);
        }
        if ($cate->delete()) {
            $res['status'] = 1;
            $res['msg'] = '删除成功！';
        }
        return response()->json($res);
    }

    /*
     * GET|HEAD
     * admin/category/{category}/edit
     * */
    public function edit($id)
    {
        $category = new Category;
        $cate = Category::find($id);
        return view('admin.category.edit', ['cate' => $cate, 'res' => $category->getTreeCate()]);
    }
}
