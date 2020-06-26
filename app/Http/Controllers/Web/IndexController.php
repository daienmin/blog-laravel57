<?php

namespace App\Http\Controllers\Web;

use App\Http\Model\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Category;

class IndexController extends Controller
{
    public $data = [];

    public function __construct()
    {
        $this->data['cate_list'] = Category::getTopCate();
        $this->data['recommend_list'] = Article::recommendList();
        $this->data['click_list'] = Article::clickList();
    }

    // 首页
    public function index()
    {
        $this->data['list'] = Article::indexList();
        return view('web.index', $this->data);
    }

    public function category($id)
    {
        if (!$id) {
            redirect('/');
        }
        $this->data['cate_info'] = Category::getOne((int) $id);
        $this->data['list'] = Article::cateList((int) $id);
        return view('web.list', $this->data);
    }

    public function article($id)
    {
        return view('web.info', $this->data);
    }

    public function tag($id)
    {
        return view('web.list', $this->data);
    }

    /*public function about()
    {
        return view('web.about', $this->data);
    }*/
}
