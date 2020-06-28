@extends('layouts.web.common')

@section('title', $art_info[0]->title);
@section('keywords', '');
@section('description', '');

@section('content')
<div class="blank"></div>
<article>
  <div class="leftbox">
    <div class="infos">
      <div class="newsview">
        <h3 class="news_title">{{ $art_info[0]->title }}</h3>
        <div class="news_author">
          <span class="au01">{{ $art_info[0]->user->username }}</span>
          <span class="au02">{{ substr($art_info[0]->created_at, 0, 10) }}</span>
          <span class="au03">共<b>309</b>人围观</span></div>
        <div class="tags"><a href="{{ url('/tag/' . $art_info[0]->label_id) }}">{{ $art_info[0]->label->label_name }}</a></div>
        <div class="news_about"><strong>简介</strong>{{ $art_info[0]->description }}</div>
        <div class="news_infos article-content" id="article-content" style="padding: 20px 0;">
          <textarea style="display:none;" placeholder="">{{ $art_info[0]->content }}</textarea>
        </div>
        <div class="nextinfo">
          <p>上一篇：
            @if(!empty($art_prev[0]))
            <a href="{{ url('/article/' . $art_prev[0]->id) }}" >{{ $art_prev[0]->title }}</a>
            @else
              没有了
            @endif
          </p>
          <p>下一篇：
            @if(!empty($art_next[0]))
              <a href="{{ url('/article/' . $art_next[0]->id) }}" >{{ $art_next[0]->title }}</a>
            @else
              没有了
            @endif
          </p>
        </div>
    {{--<div class="otherlink">
      <h2>相关文章</h2>
      <ul>
        <li><a href="/" title="云南之行――丽江古镇玉龙雪山">云南之行――丽江古镇玉龙雪山</a></li>
        <li><a href="/" title="云南之行――大理洱海一日游">云南之行――大理洱海一日游</a></li>
        <li><a href="/" target="_blank">住在手机里的朋友</a></li>
        <li><a href="/" target="_blank">豪雅手机正式发布! 在法国全手工打造的奢侈品</a></li>
        <li><a href="/" target="_blank">教你怎样用欠费手机拨打电话</a></li>
        <li><a href="/" target="_blank">原来以为，一个人的勇敢是，删掉他的手机号码...</a></li>
      </ul>
    </div>
    <div class="news_pl">
      <h2>文章评论</h2>
      <ul>
      </ul>
    </div>--}}
  </div>
  </div>
  </div>

  <div class="rightbox">
    @component('components.search')
    @endcomponent

    @component('components.list', ['list' => $recommend_list, 'title' => '置顶推荐'])
    @endcomponent

    @component('components.list', ['list' => $click_list, 'title' => '置顶推荐'])
    @endcomponent

    @component('components.link')
    @endcomponent
    {{--<div class="weixin">
      <h2 class="ab_title">微信关注</h2>
      <ul>
        <img src="images/wx.jpg">
      </ul>
    </div>--}}
  </div>
  <div class="blank"></div>
</article>
<link rel="stylesheet" href="{{ asset('editor.md/css/editormd.preview.css') }}" />
<script src="{{ asset('js/front/jquery-2.1.1.min.js') }}"></script>
<script src="{{ asset('editor.md/lib/marked.min.js') }}"></script>
<script src="{{ asset('editor.md/lib/prettify.min.js') }}"></script>
<script src="{{ asset('editor.md/lib/raphael.min.js') }}"></script>
<script src="{{ asset('editor.md/lib/underscore.min.js') }}"></script>
<script src="{{ asset('editor.md/lib/sequence-diagram.min.js') }}"></script>
<script src="{{ asset('editor.md/lib/flowchart.min.js') }}"></script>
<script src="{{ asset('editor.md/lib/jquery.flowchart.min.js') }}"></script>
<script src="{{ asset('editor.md/editormd.js') }}"></script>
<script>
    $(function() {
        editormd.katexURL = {
            css: '{{ asset('editor.md/katex.min') }}',
            js : '{{ asset('editor.md/katex.min') }}'
        };
        editormd.markdownToHTML("article-content", {
            htmlDecode      : "style,script,iframe",  // you can filter tags decode
            emoji           : true,
            taskList        : true,
            tex             : true,  // 默认不解析
            flowChart       : true,  // 默认不解析
            sequenceDiagram : true,  // 默认不解析
        });
    });
</script>
  
@endsection
