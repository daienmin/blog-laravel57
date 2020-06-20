<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Label;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LabelController extends Controller
{
    /*
     * GET|HEAD
     * admin/label
     * */
    public function index()
    {
        $label = Label::paginate(10);
        return view('admin.label.index', ['label' => $label]);
    }

    /*
     * POST
     * admin/label
     * */
    public function store(Request $request)
    {
        $data = $request->except(['_token', 's']);
        if (Label::where('label_name', $data['label_name'])->count() > 0) {
            return back()->withErrors(['标签已存在']);
        }
        if (!$data['label_name']) {
            return back()->withErrors(['请输入标签名']);
        }
        $label = new Label();
        $label->label_name = $data['label_name'];
        if ($label->save()) {
            return redirect('admin/label');
        }
        return back()->withErrors(['添加标签失败，请稍后重试']);
    }

    /*
     * GET|HEAD
     * admin/label/create
     * */
    public function create()
    {
        return view('admin.label.add');
    }

    /*
     * GET|HEAD
     * admin/label/{label}
     * */
    public function show()
    {
    }

    /*
     * PUT|PATCH
     * admin/label/{label}
     * */
    public function update($id, Request $request)
    {
        $label = Label::find($id);
        $label_name = $request->get('label_name', '');
        $label->label_name = $label_name;
        if ($label->save()) {
            return redirect('admin/label');
        }
        return back()->with('error', '更新失败');
    }

    /*
     * DELETE
     * admin/label/{label}
     * */
    public function destroy($id)
    {
        $user = Label::find($id);
        $res = ['status' => 0, 'msg' => '删除失败！'];
        if ($user->delete()) {
            $res['status'] = 1;
            $res['msg'] = '删除成功！';
        }
        return response()->json($res);
    }

    /*
     * GET|HEAD
     * admin/label/{label}/edit
     * */
    public function edit($id)
    {
        $label = Label::find($id);
//        dd($user);
        return view('admin.label.edit', ['label' => $label]);
    }
}
