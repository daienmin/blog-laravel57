@extends('layouts.web.common')

@section('title', $cate_info['cate_name'] ?: '');
@section('keywords', $cate_info['keywords'] ?: '');
@section('description', $cate_info['description'] ?: '');

@section('content')
<article>
  <div class="blank"></div>
  <div class="leftbox">
    <div class="newblogs">
      <h2 class="hometitle">{{ $cate_info['cate_name'] ?: '' }}</h2>
      <ul>
        @if(!$list->isEmpty())
          @foreach($list as $v)
        <li>
          <h3 class="blogtitle"><a href="{{ url('/article/' . $v->id) }}">{{ $v->title }}</a></h3>
          <div class="bloginfo">
            @if($v->img_url)
            <span class="blogpic">
              <a href="{{ url('/article/' . $v->id) }}">
                <img src="{{ config('filesystems.disks.public.url').'/'.explode(',', $v->img_url)[0] }}"  />
              </a>
            </span>
            @endif
            <p>{{ $v->description }}</p>
          </div>
          <div class="autor">
            <span class="cate f_l"><a href="{{ url('/category/' . $v->cate_id) }}">{{ $v->category->cate_name }}</a></span>
            <span class="lm f_l"><a href="{{ url('/tag/' . $v->label_id) }}">{{ $v->label->label_name }}</a></span>
            <span class="dtime f_l">{{ substr($v->created_at, 0, 10) }}</span><span class="viewnum f_l">浏览（{{ $v->views }}）</span>
            <!--<span class="pingl f_l">评论（<a href="/">30</a>）</span>-->
            <span class="f_r"><a href="{{ url('/article/' . $v->id) }}" class="more">阅读原文>></a></span>
          </div>
        </li>
          @endforeach
        @endif
      </ul>
      <div class="pagelist">
        {{ $list->links() }}
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
@endsection
