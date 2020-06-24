<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function index()
    {
        return view('web.index');
    }

    public function c_list($id)
    {
        return view('web.list');
    }

    public function info($id)
    {
        return view('web.info');
    }

    public function about()
    {
        return view('web.about');
    }
}
