@extends('layouts.web.common')

@section('title', '首页');
@section('keywords', '');
@section('description', '');

@section('content')
<article>
  <div class="pics">
    <ul>
      <li><i><a href="/"><img src="{{ asset('images/front/t01.jpg') }}"></a></i><span>这组图片中的静物等非常的日系</span></li>
      <li><i><a href="/"><img src="{{ asset('images/front/t04.jpg') }}"></a></i><span>这组图片中的静物等非常的日系</span></li>
      <li><i><a href="/"><img src="{{ asset('images/front/t03.jpg') }}"></a></i><span>这组图片中的静物等非常的日系</span></li>
    </ul>
  </div>
  <div class="blank"></div>
  <div class="leftbox">
    {{--<div class="tuijian">
      <h2 class="hometitle"><span><a href="/">模板分享</a><a href="/">学无止境</a><a href="/">慢生活</a><a href="/">热门标签</a></span>特别推荐</h2>
      <ul>
        <li>
          <div class="tpic"><img src="images/b01.png"></div>
          <b>6条网页设计配色原则,让你秒变配色高手</b><span>网页设计好不好看,颜色是毋庸置疑要排首位的,所以关于颜色的搭配技巧以及原则,对于每一个要学习web前端设计的新手来说,这都是一个重要的学习过程.在本教程中我们将与你分享...</span><a href="/" class="readmore">阅读原文</a></li>
        <li>
          <div class="tpic"><img src="images/b02.jpg"></div>
          <b>作为一个设计师,如果遭到质疑你是否能恪守自己的原则</b><span>就拿我自己来说吧，有时候会很矛盾，设计好的作品，不把它分享出来，会觉得待在自己电脑里面实在是没有意义...</span><a href="/" class="readmore">阅读原文</a></li>
        <li>
          <div class="tpic"><img src="images/b03.jpg"></div>
          <b>愿有人陪你一起颠沛流离</b><span>有一天晚上我收到朋友的邮件，他问我怎样可以最快地摆脱寂寞，我想了想不知道应该怎么回答他，因为我从来没有摆脱过这个问题，我只能去习惯它，就像习惯身体的一部分...</span><a href="/" class="readmore">阅读原文</a></li>
        <li>
          <div class="tpic"><img src="images/b04.jpg"></div>
          <b>你要去相信，没有到不了的明天</b><span>不管你现在是一个人走在异乡的街道上始终没有找到一丝归属感，还是你在跟朋友们一起吃饭开心地笑着的时候闪过一丝落寞。...</span><a href="/" class="readmore">阅读原文</a></li>
        <li>
          <div class="tpic"><img src="images/b05.jpg"></div>
          <b>美丽的茧</b><span>让世界拥有它的脚步，让我保有我的茧。当溃烂已极的心灵再不想做一丝一毫的思索时，就让我静静回到我的茧内，以回忆为睡榻，以悲哀为覆被，这是我唯一的美丽。...</span><a href="/" class="readmore">阅读原文</a></li>
        <li>
          <div class="tpic"><img src="images/b01.png"></div>
          <b>6条网页设计配色原则,让你秒变配色高手</b><span>网页设计好不好看,颜色是毋庸置疑要排首位的,所以关于颜色的搭配技巧以及原则,对于每一个要学习web前端设计的新手来说,这都是一个重要的学习过程.在本教程中我们将与你分享...</span><a href="/" class="readmore">阅读原文</a></li>
      </ul>
    </div>--}}
    <div class="newblogs">
      <h2 class="hometitle">最新文章</h2>
      <ul id="list" style="">
        @if(!$list->isEmpty())
          @foreach($list as $v)
        <li>
          <h3 class="blogtitle"><a href="{{ url('/article/' . $v->id) }}">{{ $v->title }}</a></h3>
          <div class="bloginfo">
            @if ($v->img_url)
            <span class="blogpic">
              <a href="{{ url('/article/' . $v->id) }}" title="">
                <img src="{{ config('filesystems.disks.public.url').'/'.explode(',', $v->img_url)[0] }}" alt="">
              </a>
            </span>
            @endif
            <p>{{ $v->description }}</p>
          </div>
          <div class="autor">
              <span class="cate f_l"><a href="{{ url('/category/' . $v->cate_id) }}">{{ $v->category->cate_name }}</a></span>
              <span class="lm f_l"><a href="{{ url('/tag/' . $v->label_id) }}">{{ $v->label->label_name }}</a></span>
              <span class="dtime f_l">{{ substr($v->created_at, 0, 10) }}</span><span class="viewnum f_l">浏览（{{ $v->views }}）</span>
              <span class="f_r"><a href="{{ url('/article/' . $v->id) }}" class="more">阅读原文</a></span>
          </div>
        </li>
          @endforeach
        @endif
      </ul>
      {{--<ul id="list2">
      </ul>
      <script src="{{ asset('js/front/page2.js') }}}"></script>--}}
    </div>
  </div>
  <div class="rightbox">
    <div class="aboutme">
      <h2 class="ab_title">关于我</h2>
      <div class="avatar"><img src="{{ asset('images/front/b04.jpg') }}" /></div>
      <div class="ab_con">
        <p>网名：DanceSmile | 即步非烟</p>
        <p>职业：Web前端设计师、网页设计 </p>
        <p>籍贯：四川省―成都市</p>
        <p>邮箱：dancesmiling@qq.com</p>
      </div>
    </div>
    <div class="blank"></div>

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
</article>
@endsection
