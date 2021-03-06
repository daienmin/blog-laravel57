<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Label;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /*
     * GET|HEAD
     * admin/article
     * */
    public function index()
    {
        $art = Article::orderBy('id', 'desc')->paginate(10);
        return view('admin.article.index', ['art' => $art]);
    }

    /*
     * POST
     * admin/article
     * */
    public function store(Request $request)
    {
        $request->validate([
            'cate_id' => 'required',
            'title' => 'required|min:2|max:100',

        ],
            [
                'cate_id.required' => '请选择分类',
                'title.required' => '请输入文章标题',
                'title.min' => '文章标题不能小于2个字符',
                'title.max' => '文章标题不能大于100个字符',
            ]
        );
        $data = $request->except(['_token', 's']);
        $obj = new Article();
        $obj->cate_id = $data['cate_id'];
        $obj->title = $data['title'];
        $obj->content = $data['content'];
        $obj->keywords = $data['keywords'] ?: '';
        $obj->description = $data['description'] ?: '';
        $obj->img_url = !empty($data['img_url']) ? implode(',', $data['img_url']) : '';
        $obj->label_id = $data['label'];
        $obj->recommend = $data['recommend'];
        $obj->status = $data['status'];
        $obj->u_id = $request->session()->get('user.id');

        if ($obj->save()) {
            return redirect('admin/article');
        }
        return back()->withErrors(['添加文章失败，请稍后重试']);
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
        $obj = Article::find($id);
        $request->validate([
            'cate_id' => 'required',
            'title' => 'required|min:2|max:100',

        ],
            [
                'cate_id.required' => '请选择分类',
                'title.required' => '请输入文章标题',
                'title.min' => '文章标题不能小于2个字符',
                'title.max' => '文章标题不能大于100个字符',
            ]
        );
        $data = $request->except(['_token', 's']);
        $obj->cate_id = $data['cate_id'];
        $obj->title = $data['title'];
        $obj->content = $data['content'];
        $obj->keywords = $data['keywords'] ?: '';
        $obj->description = $data['description'] ?: '';
        $obj->img_url = !empty($data['img_url']) ? implode(',', $data['img_url']) : '';
        $obj->label_id = $data['label'];
        $obj->recommend = $data['recommend'];
        $obj->status = $data['status'];

        if ($obj->save()) {
            return redirect('admin/article');
        }
        return back()->withErrors(['修改文章失败，请稍后重试']);
    }

    /*
     * DELETE
     * admin/article/{article}
     * */
    public function destroy($id)
    {
        $art = Article::find($id);
        $res = ['status' => 0, 'msg' => '删除失败！'];
        $img_url = $art->img_url;
        if ($art->delete()) {
            // 删除图片
            if ($img_url) {
                $img_url = array_map(function ($v) {
                    return '/'.$v;
                }, explode(',', $img_url));
                Storage::disk('public')->delete($img_url);
            }

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
        $art = Article::find($id);
        if ($art->img_url) {
            $art->img_url = explode(',', $art->img_url);
        }
        return view('admin.article.edit', [
            'art' => $art,
            'cate' => (new Category())->getTreeCate(),
            'label' => (new Label())::select(['id', 'label_name'])->get(),
        ]);
    }

    /**
     * 图片上传
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImg(Request $request)
    {
        if ($request->hasFile('img')) {
            $file = $request->file('img');

            $ext = $file->getClientOriginalExtension();

            if (!in_array($ext, ['jpg', 'png', 'gif', 'jpeg'])) {
                return response()->json(['status' => 1, 'msg' => '图片格式为jpg,png,gif,jpeg']);
            }

            $path = Storage::disk('public')->putFile('article/' . date('Y-m-d'), $request->file('img'));
            if ($path) {
                return response()->json(['status' => 0, 'msg' => '图片上传成功', 'url' => $path]);
            }
            return response()->json(['status' => 1, 'msg' => '图片上传失败，请重试']);
        }
        return response()->json(['status' => 1, 'msg' => '未找到上传文件，请检查文件是否存在']);
    }

    /**
     * 删除图片
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delImg(Request $request)
    {
        $img_url = $request->post('img_url');
        $url = '/' . $img_url;
        $storage = Storage::disk('public');
        if ($storage->exists($url) && $storage->delete($url)) {
            return response()->json(['status' => 0, 'msg' => '删除文件成功']);
        }
        return response()->json(['status' => 1, 'msg' => '删除文件失败']);
    }


}
