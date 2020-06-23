@extends('layouts.admin.common')

@section('c_header_title', '文章管理 - 添加文章')

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
                            <form action="{{ url('admin/article') }}" method="post" class="row">
                                {{ csrf_field() }}
                                <div class="form-group col-md-12">
                                    <label for="type">分类</label>
                                    <div class="form-controls">
                                        <select name="cate_id" class="form-control" id="cate_id">
                                            <option value="" selected>请选择</option>
                                            @foreach($cate as $v)
                                                <option value="{{ $v->id }}">{{ str_repeat('|——', $v->level) }}{{ $v->cate_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="title">标题</label>
                                    <input type="text" class="form-control" id="title" name="title" value="" placeholder="请输入标题" />
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="seo_keywords">关键词</label>
                                    <input type="text" class="form-control" id="keywords" name="keywords" value="" placeholder="关键词" />
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="seo_description">描述</label>
                                    <textarea class="form-control" id="description" name="description" rows="5" value="" placeholder="描述"></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>多图上传</label>
                                    <div class="form-controls">
                                        <ul class="list-inline clearfix lyear-uploads-pic">

                                            <li class="col-xs-4 col-sm-3 col-md-2">
                                                <input type="file" id="upload_img" class="hide upload-img" name="img" value="">
                                                <a class="pic-add" id="add-pic-btn" href="javascript:void(0);" title="点击上传"></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="content">内容</label>
                                    <div id="test-editor">
                                        <textarea style="display:none;"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="tags">标签</label>
                                    <div class="form-controls">
                                        <select name="label" class="form-control" id="label">
                                            <option value="0" selected>请选择</option>
                                            @foreach($label as $v)
                                                <option value="{{ $v->id }}">{{ $v->label_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="status">推荐</label>
                                    <div class="clearfix">
                                        <label class="lyear-radio radio-inline radio-primary">
                                            <input type="radio" name="recommend" value="0" checked><span>否</span>
                                        </label>
                                        <label class="lyear-radio radio-inline radio-primary">
                                            <input type="radio" name="recommend" value="1"><span>是</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="status">状态</label>
                                    <div class="clearfix">
                                        <label class="lyear-radio radio-inline radio-primary">
                                            <input type="radio" name="status" value="0"><span>未发布</span>
                                        </label>
                                        <label class="lyear-radio radio-inline radio-primary">
                                            <input type="radio" name="status" value="1" checked><span>已发布</span>
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
    <link rel="stylesheet" href="{{ asset('js/admin/jconfirm/jquery-confirm.min.css') }}">
    <script src="{{ asset('js/admin/jconfirm/jquery-confirm.min.js') }}"></script>
    <style>
        .divider{width: auto;}
    </style>
   {{-- <!--标签插件-->
    <link rel="stylesheet" href="{{ asset('js/admin/jquery-tags-input/jquery.tagsinput.min.css') }}">
    <script src="{{ asset('js/admin/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>--}}
    <script type="text/javascript"></script>
   <link rel="stylesheet" href="{{ asset('editor.md/css/editormd.css') }}" />
   {{--<script src="https://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>--}}
   <script src="{{ asset('editor.md/editormd.min.js') }}"></script>
   <script type="text/javascript">
       $(function() {
           var editor = editormd("test-editor", {
               // width  : "100%",
               name: 'content',
               height : "500px",
               path: "/editor.md/lib/"

//               appendMarkdown : md,
//               saveHTMLToTextarea : true
           });
           //testEditor.getMarkdown();       // 获取 Markdown 源码
           //testEditor.getHTML();           // 获取 Textarea 保存的 HTML 源码
           //testEditor.getPreviewedHTML();  // 获取预览窗口里的 HTML，在开启 watch 且没有开启 saveHTMLToTextarea 时使用
       });
   </script>
    <script type="text/javascript">
        /*var testEditor;

        $(function() {

            $.get('test.md', function(md){
                testEditor = editormd("test-editormd", {
                    width: "90%",
                    height: 740,
                    path : '../lib/',
                    theme : "dark",
                    previewTheme : "dark",
                    editorTheme : "pastel-on-dark",
                    markdown : md,
                    codeFold : true,
                    //syncScrolling : false,
                    saveHTMLToTextarea : true,    // 保存 HTML 到 Textarea
                    searchReplace : true,
                    //watch : false,                // 关闭实时预览
                    htmlDecode : "style,script,iframe|on*",            // 开启 HTML 标签解析，为了安全性，默认不开启
                    //toolbar  : false,             //关闭工具栏
                    //previewCodeHighlight : false, // 关闭预览 HTML 的代码块高亮，默认开启
                    emoji : true,
                    taskList : true,
                    tocm            : true,         // Using [TOCM]
                    tex : true,                   // 开启科学公式TeX语言支持，默认关闭
                    flowChart : true,             // 开启流程图支持，默认关闭
                    sequenceDiagram : true,       // 开启时序/序列图支持，默认关闭,
                    //dialogLockScreen : false,   // 设置弹出层对话框不锁屏，全局通用，默认为true
                    //dialogShowMask : false,     // 设置弹出层对话框显示透明遮罩层，全局通用，默认为true
                    //dialogDraggable : false,    // 设置弹出层对话框不可拖动，全局通用，默认为true
                    //dialogMaskOpacity : 0.4,    // 设置透明遮罩层的透明度，全局通用，默认值为0.1
                    //dialogMaskBgColor : "#000", // 设置透明遮罩层的背景颜色，全局通用，默认为#fff
                    imageUpload : true,
                    imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
                    imageUploadURL : "./php/upload.php",
                    onload : function() {
                        console.log('onload', this);
                        //this.fullscreen();
                        //this.unwatch();
                        //this.watch().fullscreen();

                        //this.setMarkdown("#PHP");
                        //this.width("100%");
                        //this.height(480);
                        //this.resize("100%", 640);
                    }
                });
            });

            $("#goto-line-btn").bind("click", function(){
                testEditor.gotoLine(90);
            });

            $("#show-btn").bind('click', function(){
                testEditor.show();
            });

            $("#hide-btn").bind('click', function(){
                testEditor.hide();
            });

            $("#get-md-btn").bind('click', function(){
                alert(testEditor.getMarkdown());
            });

            $("#get-html-btn").bind('click', function() {
                alert(testEditor.getHTML());
            });

            $("#watch-btn").bind('click', function() {
                testEditor.watch();
            });

            $("#unwatch-btn").bind('click', function() {
                testEditor.unwatch();
            });

            $("#preview-btn").bind('click', function() {
                testEditor.previewing();
            });

            $("#fullscreen-btn").bind('click', function() {
                testEditor.fullscreen();
            });

            $("#show-toolbar-btn").bind('click', function() {
                testEditor.showToolbar();
            });

            $("#close-toolbar-btn").bind('click', function() {
                testEditor.hideToolbar();
            });

            $("#toc-menu-btn").click(function(){
                testEditor.config({
                    tocDropdown   : true,
                    tocTitle      : "目录 Table of Contents",
                });
            });

            $("#toc-default-btn").click(function() {
                testEditor.config("tocDropdown", false);
            });
        });*/
    </script>

    <script type="text/javascript">
        $('#add-pic-btn').click(function () {
            if ($('.lyear-uploads-pic li').length >= 4) {
                $.confirm({
                    title: '提示',
                    content: '最多上传3张图片！',
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                        close: {
                            text: '关闭'
                        }
                    }
                });
                return false;
            }
            $('input.upload-img').click();
        });
        // 图片上传
        $('input.upload-img').change(function () {
            var formData = new FormData();
            formData.append('img', document.getElementById('upload_img').files[0]);
            $.ajax({
                type: 'POST',
                url: '{{ url('admin/article/upload_img') }}',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (res) {
                    if (res.status == 0) {
                        var prefixUrl = '{{ config('filesystems.disks.public.url') }}';
                        var htmlStr = '<li class="col-xs-4 col-sm-3 col-md-2"><figure>\n' +
                            '<img src=" ' + prefixUrl + '/' + res.url + ' " alt="">\n' +
                            '<figcaption>\n' +
                            '<input type="hidden" name="img_url[]" value="' + res.url + '">\n' +
                            '<a class="btn btn-round btn-square btn-primary hide" href="#!"><i class="mdi mdi-eye"></i></a>\n' +
                            '<a class="btn btn-round btn-square btn-danger img-del" href="javascript:void(0);"><i class="mdi mdi-delete"></i></a>\n' +
                            '</figcaption></figure></li>';
                        $('.lyear-uploads-pic li:last-child').before(htmlStr);
                    } else {
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
                    }
                    $('input.upload-img').val('');
                }
            });
        });

        // 图片删除
        $(document).on('click', '.img-del', function(){
            var _that = $(this);
            var img_url = _that.siblings('input[name="img_url[]"]').val();
            $.post('{{ url('admin/article/del_img') }}', {img_url: img_url}, function (res) {
                if (res.status == 0) {
                    _that.parents('li').remove();
                } else {
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
                }
            });
        });
    </script>
@endsection