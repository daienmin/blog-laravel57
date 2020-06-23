@extends('layouts.admin.common')

@section('c_header_title', '文章管理 - 添加分类')

@section('content')
    <main class="lyear-layout-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ url('admin/category') }}" method="post" class="row">
                                {{ csrf_field() }}
                                <div class="form-group col-md-12">
                                    <label for="type">父级分类</label>
                                    <div class="form-controls">
                                        <select name="pid" class="form-control" id="pid">
                                            <option value="0" selected>请选择</option>
                                            @foreach($res as $v)
                                                <option value="{{ $v->id }}">{{ str_repeat('|——', $v->level) }}{{ $v->cate_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="title">分类名称</label>
                                    <input type="text" class="form-control" id="cate_name" name="cate_name" value="" placeholder="请输入分类名" />
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="seo_keywords">关键字</label>
                                    <input type="text" class="form-control" id="keywords" name="keywords" value="" placeholder="请输入关键字" />
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="seo_keywords">描述</label>
                                    <input type="text" class="form-control" id="description" name="description" value="" placeholder="请输入描述" />
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="seo_keywords">排序</label>
                                    <input type="text" class="form-control" id="sort" name="sort" value="0" placeholder="请输入排序值，递增排序" />
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="status">状态</label>
                                    <div class="clearfix">
                                        <label class="lyear-radio radio-inline radio-primary">
                                            <input type="radio" name="status" value="0"><span>隐藏</span>
                                        </label>
                                        <label class="lyear-radio radio-inline radio-primary">
                                            <input type="radio" name="status" value="1" checked><span>显示</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-primary ajax-post" target-form="add-form">确 定</button>
                                    <button type="button" class="btn btn-default" onclick="javascript:history.back(-1);return false;">返 回</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script type="text/javascript"></script>
@endsection