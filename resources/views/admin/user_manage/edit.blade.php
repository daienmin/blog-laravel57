@extends('layouts.admin.common')

@section('c_header_title', '后台用户管理 - 编辑用户')

@section('content')
    <main class="lyear-layout-content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if(session('error'))
                                <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                            @endif
                            <form action="{{ url('admin/user_manage/' . $user->id) }}" method="post" class="row">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group col-md-12">
                                    <label for="title">用户名</label>
                                    <input type="text" class="form-control" id="username" name="username" readonly value="{{ $user->username }}" placeholder="" />
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="seo_keywords">重置密码</label>
                                    <input type="text" class="form-control" id="password" name="password" value="" placeholder="请输入新密码" />
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="type">角色</label>
                                    <div class="form-controls">
                                        <select name="role_id" class="form-control" id="role_id">
                                            <option value="0">管理员</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="status">状态</label>
                                    <div class="clearfix">
                                        <label class="lyear-radio radio-inline radio-primary">
                                            <input type="radio" name="status" value="0" @if($user->status != 1) checked @endif><span>禁用</span>
                                        </label>
                                        <label class="lyear-radio radio-inline radio-primary">
                                            <input type="radio" name="status" value="1" @if($user->status == 1) checked @endif><span>启用</span>
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