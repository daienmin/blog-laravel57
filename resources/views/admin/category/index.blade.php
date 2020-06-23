@extends('layouts.admin.common')

@section('c_header_title', '文章管理 - 分类列表')

@section('content')
    <main class="lyear-layout-content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-toolbar clearfix">
                            {{--<form class="pull-right search-bar" method="get" action="#!" role="form">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <input type="hidden" name="search_field" id="search-field" value="title">
                                        <button class="btn btn-default dropdown-toggle" id="search-btn" data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false">
                                            标题 <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li> <a tabindex="-1" href="javascript:void(0)" data-field="title">标题</a> </li>
                                            <li> <a tabindex="-1" href="javascript:void(0)" data-field="cat_name">栏目</a> </li>
                                        </ul>
                                    </div>
                                    <input type="text" class="form-control" value="" name="keyword" placeholder="请输入名称">
                                </div>
                            </form>--}}
                            <div class="toolbar-btn-action">
                                <a class="btn btn-primary m-r-5" href="{{ url('admin/category/create') }}"><i class="mdi mdi-plus"></i> 新增</a>
                                {{--<a class="btn btn-success m-r-5" href="#!"><i class="mdi mdi-check"></i> 启用</a>
                                <a class="btn btn-warning m-r-5" href="#!"><i class="mdi mdi-block-helper"></i> 禁用</a>
                                <a class="btn btn-danger" href="#!"><i class="mdi mdi-window-close"></i> 删除</a>--}}
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        {{--<th>
                                            <label class="lyear-checkbox checkbox-primary">
                                                <input type="checkbox" id="check-all"><span></span>
                                            </label>
                                        </th>--}}
                                        <th>ID</th>
                                        <th>分类名</th>
                                        <th>关键字</th>
                                        <th>状态</th>
                                        <th>排序</th>
                                        <th>创建时间</th>
                                        <th>修改时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($res as $val)
                                    <tr>
                                        {{--<td>
                                            <label class="lyear-checkbox checkbox-primary">
                                                <input type="checkbox" name="ids[]" value="{{ $val->id }}"><span></span>
                                            </label>
                                        </td>--}}

                                        <td>{{ $val->id }}</td>
                                        <td>{{ str_repeat("|——", $val->level) }}{{ $val->cate_name }}</td>
                                        <td>{{ $val->keywords }}</td>
                                        <td>
                                            @if($val->status)
                                                <font class="text-success">显示</font>
                                            @else
                                                <font class="text-danger">隐藏</font>
                                            @endif
                                        </td>
                                        <td><input type="text" name="sort" value="{{ $val->sort }}"></td>
                                        <td>{{ $val->created_at }}</td>
                                        <td>{{ $val->updated_at }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-xs btn-default" href="{{ url('admin/category/' . $val->id . '/edit') }}" title="编辑" data-toggle="tooltip"><i class="mdi mdi-pencil"></i></a>
                                                <a class="btn btn-xs btn-default user-del" href="javascript:void(0);" data-id="{{ $val->id }}" title="删除" data-toggle="tooltip"><i class="mdi mdi-window-close"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </main>
@endsection

@section('script')
<link rel="stylesheet" href="{{ asset('js/admin/jconfirm/jquery-confirm.min.css') }}">
<script src="{{ asset('js/admin/jconfirm/jquery-confirm.min.js') }}"></script>
<script type="text/javascript">
    $(function(){
        /*$('.search-bar .dropdown-menu a').click(function() {
            var field = $(this).data('field') || '';
            $('#search-field').val(field);
            $('#search-btn').html($(this).text() + ' <span class="caret"></span>');
        });*/

        $('.user-del').on('click', function () {
            var id = $(this).attr('data-id');
            $.confirm({
                title: '删除分类',
                content: '确认要删除这个分类吗？',
                buttons: {
                    confirm: {
                        text: '确认',
                        action: function(){
                            $.post("{{ url('admin/category') }}/"+id, {"_method": "delete", "_token": "{{ csrf_token() }}"}, function (res) {
                                if (res.status == 0) {
                                    $.confirm({
                                        title: '错误提示',
                                        content: res.msg,
                                        type: 'red',
                                        typeAnimated: true,
                                        buttons: {
                                            close: {
                                                text: '关闭'
                                            }
                                        }
                                    });
                                } else {
                                    window.location.reload(true);
                                }
                            });
                        }
                    },
                    cancel: {
                        text: '取消'
                    }
                }
            });
        });
    });
</script>
@endsection