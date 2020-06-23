@extends('layouts.admin.common')

@section('c_header_title', '文章管理 - 文章列表')

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
                                <a class="btn btn-primary m-r-5" href="{{ url('admin/article/create') }}"><i class="mdi mdi-plus"></i> 新增</a>
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
                                        <th>文章标题</th>
                                        <th>所属分类</th>
                                        <th>图片</th>
                                        <th>访问量</th>
                                        <th>作者</th>
                                        <th>状态</th>
                                        <th>推荐</th>
                                        <th>创建时间</th>
                                        <th>修改时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($art as $val)
                                    <tr>
                                        {{--<td>
                                            <label class="lyear-checkbox checkbox-primary">
                                                <input type="checkbox" name="ids[]" value="{{ $val->id }}"><span></span>
                                            </label>
                                        </td>--}}
                                        <td>{{ $val->id }}</td>
                                        <td>{{ $val->title }}</td>
                                        <td>{{ $val->category->cate_name }}</td>
                                        <td>@if ($val->img_url) <img src="{{ config('filesystems.disks.public.url').'/'.explode(',', $val->img_url)[0] }}" style="max-width: 80px;" alt=""> @endif</td>
                                        <td>{{ $val->views }}</td>
                                        <td>{{ $val->user->username }}</td>
                                        <td>
                                            @if ($val->status)
                                                已发布
                                            @else
                                                未发布
                                            @endif
                                        </td>
                                        <td>
                                            @if ($val->recommend)
                                                是
                                            @else
                                                否
                                            @endif
                                        </td>
                                        <td>{{ $val->created_at }}</td>
                                        <td>{{ $val->updated_at }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-xs btn-default" href="{{ url('admin/article/' . $val->id . '/edit') }}" title="编辑" data-toggle="tooltip"><i class="mdi mdi-pencil"></i></a>
                                                <a class="btn btn-xs btn-default user-del" href="javascript:void(0);" data-id="{{ $val->id }}" title="删除" data-toggle="tooltip"><i class="mdi mdi-window-close"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                {{ $art->links() }}
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
                title: '提示',
                content: '确认要删除这篇文章吗？',
                buttons: {
                    confirm: {
                        text: '确认',
                        action: function(){
                            $.post("{{ url('admin/article') }}/"+id, {"_method": "delete", "_token": "{{ csrf_token() }}"}, function (res) {
                                if (res.status == 0) {
                                    $.confirm({
                                        title: '提示',
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