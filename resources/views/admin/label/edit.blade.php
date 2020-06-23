@extends('layouts.admin.common')

@section('c_header_title', '文章管理 - 编辑标签')

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
                            <form action="{{ url('admin/label/' . $label->id) }}" method="post" class="row">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group col-md-12">
                                    <label for="title">标签名</label>
                                    <input type="text" class="form-control" id="label_name" name="label_name" value="{{ $label->label_name }}" placeholder="" />
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